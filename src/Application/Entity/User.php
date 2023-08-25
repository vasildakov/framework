<?php

declare(strict_types=1);

namespace Application\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Application\Repository\InMemoryUserRepository;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: InMemoryUserRepository::class)]
#[ORM\Table(name: "users")]
#[ORM\UniqueConstraint(name: "UNIQ_email", columns: ["email"])]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected UuidInterface|string $id;

    #[ORM\Column(name: 'email', type: Types::STRING, length: 255, nullable: false)]
    protected string $email;

    #[ORM\Column(name: 'name', type: Types::STRING, length: 55, nullable: false)]
    protected string $name;

    #[ORM\Column(name: 'surname', type: Types::STRING, length: 60, nullable: false)]
    protected string $surname;

    public function __construct(string $id, string $email, string $name, string $surname)
    {
        $this->id      = $id;
        $this->email   = $email;
        $this->name    = $name;
        $this->surname = $surname;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
