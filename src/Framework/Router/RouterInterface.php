<?php

declare(strict_types=1);

namespace Framework\Router;

use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    public function add(Route $route);

    public function match(ServerRequestInterface $request);
}
