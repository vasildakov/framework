<?php

declare(strict_types = 1);

namespace Framework\Container;

use Framework\Router\Adapter\LaminasRouter;
use Laminas\Router\SimpleRouteStack;
use Psr\Container\ContainerInterface;
class LaminasRouterFactory
{
    public function __invoke(ContainerInterface $container): LaminasRouter
    {
        $routes = $container->get('config')['routes'];

        $router = new SimpleRouteStack();
        foreach ($routes as $array) {
            $route = \Laminas\Router\Http\Literal::factory([
                'route' => $array['path'],
                'defaults' => [
                    'controller' => $container->get($array['handler']),
                    'action' => 'handle',
                ],
            ]);

            $router->addRoute($array['name'], $route);
        }

        return new LaminasRouter($router);
    }
}
