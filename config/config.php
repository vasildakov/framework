<?php

declare(strict_types = 1);

use Application\Action\Ping;
use Application\Action\PingFactory;
use Aura\Router\RouterContainer;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\ServiceManager\Factory\InvokableFactory;

$array = [
    'dependencies' => [
        'invokables' => [
            DateTime::class => InvokableFactory::class,
            EmitterInterface::class => SapiEmitter::class,
            RouterContainer::class => InvokableFactory::class,
        ],
        'factories' => [
            Framework\Application::class            => Framework\ApplicationFactory::class,
            Framework\Router\RouterInterface::class => Framework\Container\RouterFactory::class,
            Ping::class => PingFactory::class
        ],
    ],
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'method' => 'GET',
            'handler' => Application\Action\Home::class
        ],
        [
            'name' => 'ping',
            'path' => '/ping',
            'method' => 'GET',
            'handler' => Application\Action\Ping::class
        ],
        [
            'name' => 'example',
            'path' => '/example',
            'method' => 'GET',
            'handler' => Application\Action\Example::class
        ]
    ]
];

$config = new ArrayObject($array);

return (array) $config;
