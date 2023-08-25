<?php

declare(strict_types=1);

namespace Application\Repository;

use Application\Entity\User;

class DoctrineUserRepository implements UserRepositoryInterface
{

    public function find(string $id): User|null
    {
        // TODO: Implement find() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }
}
