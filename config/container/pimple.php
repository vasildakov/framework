<?php

declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as PsrContainer;

$config = require __DIR__ . '/../config.php';

$container = new Container();

return $container;
