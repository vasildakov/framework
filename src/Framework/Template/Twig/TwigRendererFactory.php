<?php

declare(strict_types=1);

namespace Framework\Template\Twig;

use ArrayObject;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Error\LoaderError;

use function array_replace_recursive;
use function get_debug_type;
use function is_array;
use function sprintf;

class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = self::mergeConfig($config);
        /** @var Environment $environment */
        $environment = $container->get(Environment::class);
        $environment->addExtension(new \Twig\Extension\DebugExtension());
        $environment->addGlobal('navigation', $this->getNavigationArray());

        return new TwigRenderer($environment, $config['extension'] ?? 'html.twig');
    }


    private function getNavigationArray(): array
    {
        // https://twig.symfony.com/doc/2.x/advanced.html
        return [
            [
                'label' => 'Home',
                'route' => '/'
            ],
            [
                'label' => 'Features',
                'route' => '/features'
            ],
            [
                'label' => 'Contact',
                'route' => '/contact'
            ],
            [
                'label' => 'About',
                'route' => '/about'
            ]

        ];
    }

    public static function mergeConfig($config): array
    {
        $config = $config instanceof ArrayObject ? $config->getArrayCopy() : $config;

        if (! is_array($config)) {
            throw new Exception\InvalidConfigException(sprintf(
                'Config service MUST be an array or ArrayObject; received %s',
                get_debug_type($config)
            ));
        }

        $mezzioConfig = isset($config['templates']) && is_array($config['templates'])
            ? $config['templates']
            : [];
        $twigConfig   = isset($config['twig']) && is_array($config['twig'])
            ? $config['twig']
            : [];

        return array_replace_recursive($mezzioConfig, $twigConfig);
    }
}