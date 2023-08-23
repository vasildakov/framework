<?php

namespace Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;

use Laminas\Diactoros\Response\JsonResponse;

class Ping implements MiddlewareInterface
{
    /**
     * @param  ServerRequestInterface   $request
     * @param  RequestHandlerInterface        $handler
     * @return ResponseInterface        $response
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler = null
    ) :ResponseInterface {
        return new JsonResponse(['ack' => time()], 200);
    }
}
