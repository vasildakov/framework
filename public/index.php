<?php

declare(strict_types=1);

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use Application\Action\Home;
use Laminas\ServiceManager\ServiceManager;
use Aura\Router\RouterContainer;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

use Framework\Action\Ping;
use Framework\Application;
use Framework\Router\RouterInterface;
use Framework\Router\AuraRouter;


(function() {

    //$container = require 'config/container.php';

    /** @var \Psr\Container\ContainerInterface $container */
    $container = new ServiceManager();

    // Router
    $container->setFactory(RouterInterface::class, function ($container) {
        return new AuraRouter(new RouterContainer());
    });

    // Emitter
    $container->setFactory(EmitterInterface::class, function ($container) {
        return new SapiEmitter();
    });

    // Datetime
    $container->setFactory(DateTime::class, function ($container) {
        return new DateTime();
    });

    // Home
    $container->setFactory(Ping::class, function ($container) {
        $datetime = $container->get(DateTime::class);
        return new Ping($datetime);
    });

    // Ping
    $container->setFactory(Home::class, function ($container) {
        $datetime = $container->get(DateTime::class);
        return new Home();
    });

    // Application
    $container->setFactory(Application::class, function ($container) {
        $router  = $container->get(RouterInterface::class);
        $emitter = $container->get(EmitterInterface::class);
        return new Application($router, $emitter);
    });

    $application = $container->get(Application::class);

    $application->route('/', $container->get(Home::class), 'GET', 'home');
    $application->route('/ping', $container->get(Ping::class), 'GET', 'ping');

    $application->run();
})();