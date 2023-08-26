<?php

declare(strict_types=1);

namespace Framework\Template\Twig;

use ArrayObject;
use Couchbase\BaseException;
use DateTimeZone;
use Exception;
use Framework\Template\Exception\InvalidConfigException;
use Framework\Template\Exception\InvalidExtensionException;
use Framework\Template\Exception\InvalidRuntimeLoaderException;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\CoreExtension;
use Twig\Extension\DebugExtension;
use Twig\Extension\ExtensionInterface;
use Twig\Loader\FilesystemLoader;
use Twig\NodeVisitor\OptimizerNodeVisitor;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

use function get_debug_type;
use function is_array;
use function is_numeric;
use function is_string;
use function sprintf;

class TwigEnvironmentFactory
{
    /**
     * @throws LoaderError
     */
    public function __invoke(ContainerInterface $container): Environment
    {
        $config = $container->has('config') ? $container->get('config') : [];

        if (! is_array($config) && ! $config instanceof ArrayObject) {
            throw new InvalidConfigException(sprintf(
                '"config" service must be an array or ArrayObject for the %s to be able to consume it; received %s',
                self::class,
                get_debug_type($config)
            ));
        }

        $debug  = (bool) ($config['debug'] ?? false);
        $config = TwigRendererFactory::mergeConfig($config);

        // Create the engine instance
        $loader      = new FilesystemLoader();
        $environment = new Environment($loader, [
            'cache'            => $config['cache_dir'] ?? false,
            'debug'            => $config['debug'] ?? $debug,
            'strict_variables' => $config['strict_variables'] ?? $debug,
            'auto_reload'      => $config['auto_reload'] ?? $debug,
            'optimizations'    => $config['optimizations'] ?? OptimizerNodeVisitor::OPTIMIZE_ALL,
            'autoescape'       => $config['autoescape'] ?? 'html',
        ]);

        if (isset($config['timezone'])) {
            $timezone = $config['timezone'];
            if (! is_string($timezone)) {
                throw new InvalidConfigException('"timezone" configuration value must be a string');
            }
            try {
                $timezone = new DateTimeZone($timezone);
            } catch (Exception) {
                throw new InvalidConfigException(sprintf('Unknown or invalid timezone: "%s"', $timezone));
            }
            $environment->getExtension(CoreExtension::class)->setTimezone($timezone);
        }

        // Add mezzio twig extension if requirements are met
        /* if (
            $container->has(TwigExtension::class)
            && $container->has(ServerUrlHelper::class)
            && $container->has(UrlHelper::class)
        ) {
            $environment->addExtension($container->get(TwigExtension::class));
        } */

        // Add debug extension
        if ($debug) {
            $environment->addExtension(new DebugExtension());
        }

        // Add user defined extensions
        $extensions = isset($config['extensions']) && is_array($config['extensions'])
            ? $config['extensions']
            : [];
        $this->injectExtensions($environment, $container, $extensions);

        // Add user defined runtime loaders
        $runtimeLoaders = isset($config['runtime_loaders']) && is_array($config['runtime_loaders'])
            ? $config['runtime_loaders']
            : [];
        $this->injectRuntimeLoaders($environment, $container, $runtimeLoaders);

        // Add template paths
        $allPaths = isset($config['paths']) && is_array($config['paths']) ? $config['paths'] : [];
        foreach ($allPaths as $namespace => $paths) {
            $namespace = is_numeric($namespace) ? null : $namespace;
            $namespace = $namespace ?: FilesystemLoader::MAIN_NAMESPACE;
            foreach ((array) $paths as $path) {
                $loader->addPath($path, $namespace);
            }
        }

        // Inject environment
        return $environment;
    }

    /**
     * Inject extensions into the TwigEnvironment instance.
     */
    private function injectExtensions(
        Environment $environment,
        ContainerInterface $container,
        array $extensions
    ): void {
        foreach ($extensions as $extension) {
            $extension = $this->loadExtension($extension, $container);

            if (! $environment->hasExtension($extension::class)) {
                $environment->addExtension($extension);
            }
        }
    }

    /**
     * Load an extension.
     *
     * If the extension is a string service name, retrieves it from the container.
     *
     * If the extension is not an ExtensionInterface, raises an exception.
     *
     * @param string|ExtensionInterface $extension
     */
    private function loadExtension($extension, ContainerInterface $container): ExtensionInterface
    {
        // Load the extension from the container if present
        if (is_string($extension) && $container->has($extension)) {
            $extension = $container->get($extension);
        }

        if (! $extension instanceof ExtensionInterface) {
            throw new InvalidExtensionException(sprintf(
                'Twig extension must be an instance of %s; "%s" given,',
                ExtensionInterface::class,
                get_debug_type($extension)
            ));
        }

        return $extension;
    }

    /**
     * Inject Runtime Loaders into the TwigEnvironment instance.
     */
    private function injectRuntimeLoaders(
        Environment $environment,
        ContainerInterface $container,
        array $runtimes
    ): void {
        foreach ($runtimes as $runtimeLoader) {
            $runtimeLoader = $this->loadRuntimeLoader($runtimeLoader, $container);
            $environment->addRuntimeLoader($runtimeLoader);
        }
    }

    /**
     * @param string|RuntimeLoaderInterface $runtimeLoader
     */
    private function loadRuntimeLoader($runtimeLoader, ContainerInterface $container): RuntimeLoaderInterface
    {
        // Load the runtime loader from the container
        if (is_string($runtimeLoader) && $container->has($runtimeLoader)) {
            $runtimeLoader = $container->get($runtimeLoader);
        }

        if (! $runtimeLoader instanceof RuntimeLoaderInterface) {
            throw new InvalidRuntimeLoaderException(sprintf(
                'Twig runtime loader must be an instance of %s; "%s" given,',
                RuntimeLoaderInterface::class,
                get_debug_type($runtimeLoader)
            ));
        }

        return $runtimeLoader;
    }
}
