<?php declare(strict_types = 1);

namespace Framework;

use ArrayObject;
use Psr\Container\ContainerInterface;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Framework\Router\RouterInterface;

class ApplicationFactory
{
    /**
     * @param  ContainerInterface $container
     * @return ApplicationInterface
     */
    public function __invoke(ContainerInterface $container) : ApplicationInterface
    {
        $config = $container->has('config') ? $container->get('config') : [];

        $config = $config instanceof ArrayObject ? $config->getArrayCopy() : $config;

        // router
        $router = $container->has(RouterInterface::class)
                ? $container->get(RouterInterface::class)
                : null;

        // emitter
        $emitter = $container->has(EmitterInterface::class)
            ? $container->get(EmitterInterface::class)
            : null;

        $application = new Application($router, $container, $emitter);

        return $application;
    }
}
