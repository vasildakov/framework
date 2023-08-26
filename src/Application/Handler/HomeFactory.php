<?php

/*
 * This file is part of the Neutrino package.
 *
 * (c) Vasil Dakov <vasildakov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Application\Handler;

use Application\Service\ImmutableClock;
use Framework\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

/**
 * Class HomeFactory
 *
 * @author Vasil Dakov <vasildakov@gmail.com>
 * @copyright 2009-2023 Neutrino.bg
 * @version 1.0
 */
class HomeFactory
{
    public function __invoke(ContainerInterface $container): Home
    {
        return new Home($container->get(TemplateRendererInterface::class));
    }
}
