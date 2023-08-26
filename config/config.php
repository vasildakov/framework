<?php

declare(strict_types = 1);

use Application\Handler;
use Application\Service;
use Aura\Router\RouterContainer;
use Framework\Template\TemplateRendererInterface;
use Framework\Template\Twig\TwigRenderer;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Twig\Environment;

$array = [
    'dependencies' => [
        'aliases'   => [
            TemplateRendererInterface::class => TwigRenderer::class,
            'Twig_Environment'               => Environment::class,
        ],
        'invokables' => [
            EmitterInterface::class => SapiEmitter::class,
            RouterContainer::class => InvokableFactory::class,
        ],
        'factories' => [
            Framework\Application::class => Framework\ApplicationFactory::class,
            Framework\Router\RouterInterface::class => Framework\Container\RouterFactory::class,
            Environment::class   => Framework\Template\Twig\TwigEnvironmentFactory::class,
            //TwigExtension::class => Framework\Template\Twig\TwigExtensionFactory::class,
            TwigRenderer::class  => Framework\Template\Twig\TwigRendererFactory::class,


            DateTime::class => InvokableFactory::class,
            Handler\Ping::class => Handler\PingFactory::class,
            Handler\Home::class => Handler\HomeFactory::class,
            Handler\Example::class => InvokableFactory::class,
            Handler\FindAllUsers::class => Handler\FindAllUsersFactory::class,
            Service\ImmutableClock::class => InvokableFactory::class,
            Application\Repository\InMemoryUserRepository::class => InvokableFactory::class,
        ],
    ],
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'method' => 'GET',
            'handler' => Handler\Home::class
        ],
        [
            'name' => 'ping',
            'path' => '/ping',
            'method' => 'GET',
            'handler' => Handler\Ping::class
        ],
        [
            'name' => 'example',
            'path' => '/example',
            'method' => 'GET',
            'handler' => Handler\Example::class
        ],
            [
            'name' => 'users',
            'path' => '/users',
            'method' => 'GET',
            'handler' => Handler\FindAllUsers::class
        ]
    ],
    'templates' => [
        'extension' => '',
        'paths' => [
            // namespace / path pairs
            '__main__' => './templates',
        ],
    ],
    'twig' => [
        'cache_dir' => './data/cached_templates',
        'assets_url' => 'base URL for assets',
        'assets_version' => '1.0',
        'extension' => 'html.twig',
        'extensions' => [
            // extension service names or instances
        ],
        'runtime_loaders' => [
            // runtime loaders names or instances
        ],
        'globals' => [
            // Global variables passed to twig templates
            'ga_tracking' => 'UA-XXXXX-X'
        ],
        'timezone' => 'America/New_York',
        'optimizations' => -1, // -1: Enable all (default), 0: disable optimizations
        'autoescape' => 'html', // Auto-escaping strategy [html|js|css|url|false]
        'auto_reload' => true, // Recompile the template whenever the source code changes
        'debug' => true, // When set to true, the generated templates have a toString() method
        'strict_variables' => true, // When set to true, twig throws an exception on invalid variables
    ],
];

$config = new ArrayObject($array);

return (array) $config;
