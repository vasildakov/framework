<?php

declare(strict_types=1);

use Framework\ApplicationInterface;
use Psr\Container\ContainerInterface;

error_reporting(E_ALL & ~E_DEPRECATED);

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(static function (): void {
    /** @var ContainerInterface $container */
    $container = require './config/container/laminas.php';

    /** @var ApplicationInterface $application */
    $application = $container->get(\Framework\Application::class);

    $application->run();
})();
