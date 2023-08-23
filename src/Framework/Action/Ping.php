<?php

namespace Framework\Action;

use Psr\Http\Server\MiddlewareInterface;

use Fig\Http\Message\StatusCodeInterface;
use Fig\Http\Message\RequestMethodInterface;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Server\RequestHandlerInterface;

class Ping implements MiddlewareInterface
{
    /**
     * @param \DateTime $datetime
     */
    public function __construct(\DateTime $datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler = null): ResponseInterface
    {
        $timestamp = $this->datetime->getTimestamp();

        return new JsonResponse(['ack' => $timestamp],StatusCodeInterface::STATUS_OK);
    }
}
