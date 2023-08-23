<?php declare(strict_types = 1);

namespace Framework\Router;

// use Aura\Router\Route as AuraRoute;
// use Aura\Router\RouterContainer;
// use Aura\Router\Rule\Path;

use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;

class AuraRouter implements RouterInterface
{
    /**
     * @var RouterContainer
     */
    private $router;

    /**
     * @var \Aura\Router\Route[]
     */
    private $routes = [];

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
     */
    public function add(Route $route)
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
     */
    public function match(ServerRequestInterface $request)
    {
        $matcher = $this->router->getMatcher();

        return $matcher->match($request);
    }
}
