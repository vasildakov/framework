<?php

namespace Application\Handler;

use Framework\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class FeaturesHandlerFactory
{
    public function __invoke(ContainerInterface $container): FeaturesHandler
    {
        return new FeaturesHandler($container->get(TemplateRendererInterface::class));
    }
}