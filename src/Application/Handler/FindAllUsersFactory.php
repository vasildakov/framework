<?php

declare(strict_types=1);

namespace Application\Handler;

use Application\Repository\InMemoryUserRepository;
use Psr\Container\ContainerInterface;

final class FindAllUsersFactory
{
    public function __invoke(ContainerInterface $container): FindAllUsers
    {
        return new FindAllUsers(
            $container->get(InMemoryUserRepository::class)
        );
    }
}