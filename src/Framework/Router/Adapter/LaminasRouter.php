<?php

declare(strict_types = 1);

namespace Framework\Router\Adapter;

use Framework\Router\Route;
use Framework\Router\RouterInterface;
use Laminas\Psr7Bridge\Psr7ServerRequest;
use Laminas\Router\Http\TreeRouteStack;
use Laminas\Router\RouteMatch;
use Laminas\Router\RouteStackInterface;
use Psr\Http\Message\ServerRequestInterface;

class LaminasRouter implements RouterInterface
{
    private ?RouteStackInterface $router;

    public function __construct(RouteStackInterface $router = null)
    {
        if (null === $router) {
            $router = new TreeRouteStack();
        }
        $this->router = $router;
    }

    public function add(Route $route): void
    {
        $this->router->addRoute($route->name(), $route);
    }

    public function match(ServerRequestInterface $request): ?Route
    {
        // Convert a PSR-7 ServerRequest to a Laminas\Http server-side request.
        $request = Psr7ServerRequest::toLaminas($request, true);

        $match = $this->router->match($request);
        if ($match instanceof RouteMatch) {
            extract($match->getParams());
            return new Route(
                path: $request->getUri()->getPath(),
                handler: $controller,
                method: $request->getMethod(),
                name: $match->getMatchedRouteName()
            );
        }
        return null;
    }
}
