<?php

declare(strict_types = 1);

use Application\Handler;
use Application\Service;
use Aura\Router\RouterContainer;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\ServiceManager\Factory\InvokableFactory;

$array = [
    'dependencies' => [
        'invokables' => [


            EmitterInterface::class => SapiEmitter::class,
            RouterContainer::class => InvokableFactory::class,

        ],
        'factories' => [
            Framework\Application::class            => Framework\ApplicationFactory::class,
            Framework\Router\RouterInterface::class => Framework\Container\RouterFactory::class,
            DateTime::class => InvokableFactory::class,
            Handler\Ping::class => Handler\PingFactory::class,
            Handler\Home::class => InvokableFactory::class,
            Handler\Example::class => InvokableFactory::class,
            Service\ImmutableClock::class => InvokableFactory::class,
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
        ]
    ]
];

$config = new ArrayObject($array);

return (array) $config;
