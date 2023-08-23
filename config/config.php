<?php

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

$array = [
    'dependencies' => [
        'invokables' => [
            EmitterInterface::class => SapiEmitter::class
        ],
        'factories' => [
            Framework\Application::class            => Framework\ApplicationFactory::class,
            Framework\Router\RouterInterface::class => Framework\Container\RouterFactory::class,
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
        ]
    ]
];

$config = new ArrayObject($array);

return (array) $config;
