# Framework
framework


```php

// Route
interface Route {
    public function path();
    public function handler();
    public function method();
    public function path();
}

// Router
interface Router {
    public function add(Route $route);
    public function match(Request $request);
}

// Action/Middleware
interface Action implements MiddlewareInterface {
    public function process(Request $request, Delegate $delegate);
}

// Application
interface Application {
    public function run(Request $request) : Response;
    public function route($path, $handler, $method, $name);
    public function process(Request $request);
}

```


## Container

```bash
$ composer require zendframework/zend-servicemanager
```

```php
<?php

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

// Load configuration
$config = require __DIR__ . '/config.php';

// Build container
$container = new ServiceManager();
(new Config($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);

return $container;

```


## Run app

```
$ php -S 0.0.0.0:8080 -t public public/index.php
```


        "php": "^8.1",
        "container-interop/container-interop": "^1.1",
        "fig/http-message-util": "^1.1",
        "psr/container": "^1.0",
        "psr/http-message": "^1.0",
        "zendframework/zend-diactoros": "^1.3",
        "aura/router": "^3.1",
        "zendframework/zend-json": "^3.0",
        "zendframework/zend-servicemanager": "^3.3",
        "http-interop/http-middleware": "^0.4.1"


        "phpunit/phpunit": "^6.0",
        "squizlabs/php_codesniffer": "^2.8",
        "filp/whoops": "^1.1 || ^2.0",
        "satooshi/php-coveralls": "^1.0",
        "phpunit/php-code-coverage": "^5.0",
        "phpmetrics/phpmetrics": "^2.0"
