<?php

namespace Framework\Container;

use Framework\Router\Adapter\FastRouteAdapter;
use Psr\Container\ContainerInterface;

class FastRouteFactory
{
    public function __invoke(ContainerInterface $container): FastRouteAdapter
    {
        return new FastRouteAdapter();
    }
}