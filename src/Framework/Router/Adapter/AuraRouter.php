<?php

declare(strict_types = 1);

namespace Framework\Router\Adapter;

use Aura\Router\Exception\ImmutableProperty;
use Aura\Router\Exception\RouteAlreadyExists;
use Aura\Router\Route as AuraRoute;
use Aura\Router\RouterContainer;
use Framework\Router\Route;
use Framework\Router\RouterInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuraRouter implements RouterInterface
{
    /**
     * @var ?RouterContainer
     */
    private ?RouterContainer $router;

    /**
     * @var AuraRoute[]
     */
    private array $routes = [];

    /**
     * @param RouterContainer|null $router
     */
    public function __construct(RouterContainer $router = null)
    {
        if (null === $router) {
            $router = new RouterContainer();
        }
        $this->router = $router;
    }

    /**
     * @param Route $route
     * @throws ImmutableProperty
     * @throws RouteAlreadyExists
     */
    public function add(Route $route): void
    {
        $auraRoute = new AuraRoute();
        $auraRoute->name($route->name());
        $auraRoute->path($route->path());
        $auraRoute->handler($route->handler());
        $auraRoute->allows($route->method());

        $this->router->getMap()->addRoute($auraRoute);
    }

    /**
     * @param ServerRequestInterface $request
     * @return bool|Route
     */
    public function match(ServerRequestInterface $request): bool|\Aura\Router\Route
    {
        $matcher = $this->router->getMatcher();

        return $matcher->match($request);
    }
}
