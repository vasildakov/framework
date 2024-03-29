<?php

declare(strict_types = 1);

use Interop\Container\ContainerInterface;

use Laminas\ServiceManager\ServiceManager;
use Laminas\ServiceManager\Factory\InvokableFactory;

use Laminas\ServiceManager\Config;

// Load configuration
$config = require __DIR__ . '/config.php';

// Build the container
$container = new ServiceManager();
(new Config($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);

return $container;
