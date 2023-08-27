<?php

namespace Framework\Router\Adapter;

use Framework\Router\Route;
use Framework\Router\RouterInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Routing\Route as SymfonyRoute;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;


class SymfonyRouter implements RouterInterface
{
    private RouteCollection $router;

    public function __construct(?RouteCollection $router = null)
    {
        $this->router = new RouteCollection();
    }

    public function add(Route $route)
    {
        $this->router->add($route->name(), new SymfonyRoute(
            $route->path(),
            ['_controller' => $route->handler()]
        ));
    }

    public function match(ServerRequestInterface $request)
    {
        $route = new SymfonyRoute('/blog/{slug}', ['_controller' => BlogController::class]);
    }
}