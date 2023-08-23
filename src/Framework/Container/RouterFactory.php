<?php

declare(strict_types = 1);

namespace Framework\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Aura\Router\RouterContainer as Router;
use Framework\Router\AuraRouter as AuraBridge;
use Psr\Container\NotFoundExceptionInterface;

class RouterFactory
{
    /**
     * @param ContainerInterface $container
     * @return AuraBridge
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AuraBridge
    {
        $routes = $container->get('config')['routes'];

        $router = new Router();
        $map = $router->getMap();

        foreach ($routes as $route) {
            extract($route);
            $map->route($name, $path, new $handler)->allows($method);
        }

        return new AuraBridge($router);
    }
}
