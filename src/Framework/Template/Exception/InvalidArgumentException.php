<?php

declare(strict_types=1);

namespace Framework\Template\Exception;

use InvalidArgumentException as SplInvalidArgumentException;

class InvalidArgumentException extends SplInvalidArgumentException implements ExceptionInterface
{
}