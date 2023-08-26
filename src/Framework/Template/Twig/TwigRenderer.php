<?php

declare(strict_types=1);

namespace Framework\Template\Twig;

use Exception;
use Framework\Template\ArrayParametersTrait;
use Framework\Template\DefaultParamsTrait;
use Framework\Template\TemplatePath;
use Framework\Template\TemplateRendererInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderer implements TemplateRendererInterface
{
    use ArrayParametersTrait;
    use DefaultParamsTrait;

    private string $suffix;

    /** @var FilesystemLoader */
    protected $twigLoader;

    /** @var Environment */
    protected $template;

    public function __construct(?Environment $template = null, string $suffix = 'html')
    {
        if (null === $template) {
            $template = $this->createTemplate($this->getDefaultLoader());
        }

        try {
            $loader = $template->getLoader();
        } catch (Exception) {
            $loader = $this->getDefaultLoader();
            $template->setLoader($loader);
        }

        $this->template   = $template;
        $this->twigLoader = $loader;
        $this->suffix     = is_string($suffix) ? $suffix : 'html';
    }

    /**
     * Create a default Twig environment
     */
    private function createTemplate(FilesystemLoader $loader): Environment
    {
        return new Environment($loader);
    }

    /**
     * Get the default loader for template
     */
    private function getDefaultLoader(): FilesystemLoader
    {
        return new FilesystemLoader();
    }

    public function render(string $name, $params = []): string
    {
        // Merge parameters based on requested template name
        $params = $this->mergeParams($name, $this->normalizeParams($params));

        $name = $this->normalizeTemplate($name);

        // Merge parameters based on normalized template name
        $params = $this->mergeParams($name, $params);

        return $this->template->render($name, $params);
    }

    public function addPath(string $path, ?string $namespace = null): void
    {
        $namespace = $namespace ?: FilesystemLoader::MAIN_NAMESPACE;
        $this->twigLoader->addPath($path, $namespace);
    }


    public function getPaths(): array
    {
        $paths = [];
        foreach ($this->twigLoader->getNamespaces() as $namespace) {
            $name = $namespace !== FilesystemLoader::MAIN_NAMESPACE ? $namespace : null;

            foreach ($this->twigLoader->getPaths($namespace) as $path) {
                $paths[] = new TemplatePath($path, $name);
            }
        }
        return $paths;
    }

    public function normalizeTemplate(string $template): string
    {
        $template = preg_replace('#^([^:]+)::(.*)$#', '@$1/$2', $template);
        if (! preg_match('#\.[a-z]+$#i', $template)) {
            return sprintf('%s.%s', $template, $this->suffix);
        }

        return $template;
    }

}