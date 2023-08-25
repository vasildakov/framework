<?php

declare(strict_types = 1);

namespace Framework\Router;

use Aura\Router\Exception\ImmutableProperty;
use Aura\Router\Exception\RouteAlreadyExists;
use Aura\Router\Route;
use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;

class AuraRouter implements RouterInterface
{
    /**
     * @var ?RouterContainer
     */
    private ?RouterContainer $router;

    /**
     * @var \Aura\Router\Route[]
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
     * @param \Framework\Router\Route $route
     * @throws ImmutableProperty
     * @throws RouteAlreadyExists
     */
    public function add(\Framework\Router\Route $route): void
    {
        $auraRoute = new \Aura\Router\Route();
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
