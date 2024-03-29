<?php

declare(strict_types=1);

namespace Framework;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ApplicationInterface
{
    /**
     * @param  ServerRequestInterface $request
     */
    public function run(ServerRequestInterface $request);
}
