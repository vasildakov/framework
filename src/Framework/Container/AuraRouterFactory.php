<?php

declare(strict_types = 1);

namespace Framework\Container;

use Aura\Router\RouterContainer as Router;
use Framework\Router\Adapter\AuraRouter;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuraRouterFactory
{
    /**
     * @param ContainerInterface $container
     * @return AuraRouter
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AuraRouter
    {
        $routes = $container->get('config')['routes'];

        $router = new Router();
        $map = $router->getMap();

        foreach ($routes as $route) {
            extract($route);
            $handler = $container->get($handler);
            $map->route($name, $path, $handler)->allows($method);
        }

        return new AuraRouter($router);
    }
}
