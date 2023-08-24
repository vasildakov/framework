<?php

declare(strict_types=1);

error_reporting(E_ALL & ~E_DEPRECATED);

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(function() {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var \Framework\ApplicationInterface $application */
    $application = $container->get(\Framework\Application::class);

    $application->run();
})();
