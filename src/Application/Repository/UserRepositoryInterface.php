<?php

namespace Application\Repository;

use Application\Entity\User;

interface UserRepositoryInterface
{
    public function find(string $id): User|null;

    public function findAll(): array;
}
