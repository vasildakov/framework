<?php

declare(strict_types=1);

namespace Application\Handler;

use Application\Repository\UserRepositoryInterface;
use Framework\Handler\AbstractHandler;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FindAllUsers extends AbstractHandler
{
    public function __construct(
        readonly UserRepositoryInterface $users
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(
            $this->users->findAll()
        );
    }
}
