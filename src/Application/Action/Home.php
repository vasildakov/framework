<?php

declare(strict_types = 1);

namespace Application\Action;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Home
{
    /**
     * @param  RequestInterface   $request
     * @return ResponseInterface  $response
     */
    public function __invoke(RequestInterface $request) : ResponseInterface
    {

    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler = null): ResponseInterface
    {
        return new JsonResponse(
            [
                'page' => 'home'
            ],
            StatusCodeInterface::STATUS_OK
        );
    }
}
