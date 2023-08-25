<?php

declare(strict_types=1);

namespace Application\Repository;

use Application\Entity\User;

/**
 * In memory implementation of UserRepositoryInterface
 */
class InMemoryUserRepository implements UserRepositoryInterface
{
    private array $data = [
        1 => [
            'id'      => 1,
            'email'   => 'Georg.Hegel@philosophy.com',
            'name'    => 'Georg',
            'surname' => 'Hegel',
        ],
        2 => [
            'id'      => 2,
            'email'   => 'Arthur.Schopenhauer@philosophy.com',
            'name'    => 'Arthur',
            'surname' => 'Schopenhauer',
        ],
        3 => [
            'id'      => 3,
            'email'   => 'Martin.Heidegger@philosophy.com',
            'name'    => 'Heidegger',
            'surname' => 'Heidegger',
        ],
        4 => [
            'id'      => 4,
            'email'   => 'Edmund.Husserl@philosophy.com',
            'name'    => 'Edmund',
            'surname' => 'Husserl',
        ],
        5 => [
            'id'      => 5,
            'email'   => 'Friedrich.Schiller@philosophy.com',
            'name'    => 'Friedrich',
            'surname' => 'Schiller',
        ],
        6 => [
            'id'      => 6,
            'email'   => 'Friedrich.Nietzsche@philosophy.com',
            'name'    => 'Friedrich',
            'surname' => 'Nietzsche',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        return array_map(function ($data) {
            return (new User(
                (string) $data['id'],
                $data['email'],
                $data['name'],
                $data['surname'],
            ))->toArray();
        }, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function find(string $id): User|null
    {
        if (! isset($this->data[$id])) {
            return null;
        }

        return new User(
            $this->data[$id]['id'],
            $this->data[$id]['email'],
            $this->data[$id]['name'],
            $this->data[$id]['surname']
        );
    }

    public function get(string $id): User
    {
        if (! isset($this->data[$id])) {
            throw new \DomainException(sprintf('User by id "%s" not found', $id));
        }

        return new User(
            $this->data[$id]['id'],
            $this->data[$id]['email'],
            $this->data[$id]['name'],
            $this->data[$id]['surname']
        );
    }
}
