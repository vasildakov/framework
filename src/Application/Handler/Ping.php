<?php

declare(strict_types = 1);

namespace Application\Handler;

use Fig\Http\Message\StatusCodeInterface;
use Framework\Handler\AbstractHandler;
use Psr\Clock\ClockInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Laminas\Diactoros\Response\JsonResponse;

final class Ping extends AbstractHandler
{
    public function __construct(
        readonly ClockInterface $clock
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface        $response
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(
            [
                'ack' => $this->clock->now()->getTimestamp()
            ],
            StatusCodeInterface::STATUS_OK
        );
    }
}
