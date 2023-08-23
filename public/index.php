<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use Laminas\ServiceManager\ServiceManager;
use Aura\Router\RouterContainer;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

use Framework\Action\Ping;
use Framework\Application;
use Framework\Router\RouterInterface;
use Framework\Router\AuraRouter;


$container = new ServiceManager;

// router
$container->setFactory(RouterInterface::class, function ($container) {
    return new AuraRouter(new RouterContainer());
});

// emitter
$container->setFactory(EmitterInterface::class, function ($container) {
    return new SapiEmitter();
});

// datetime
$container->setFactory(DateTime::class, function ($container) {
    return new DateTime();
});

// ping
$container->setFactory(Ping::class, function ($container) {
    $datetime = $container->get(DateTime::class);
    return new Ping($datetime);
});

// application
$container->setFactory(Application::class, function ($container) {
    $router  = $container->get(RouterInterface::class);
    $emitter = $container->get(EmitterInterface::class);
    return new Application($router, $emitter);
});


$application = $container->get(Application::class);

$application->route('/ping', $container->get(Ping::class), 'GET', 'ping');

$application->run();