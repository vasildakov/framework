<?php

declare(strict_types=1);

namespace Framework\Template\Exception;

use DomainException;

class RenderingException extends DomainException implements ExceptionInterface
{
}