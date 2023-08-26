<?php

/*
 * This file is part of the Neutrino package.
 *
 * (c) Vasil Dakov <vasildakov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Framework\Template;

use Stringable;

class TemplatePath implements Stringable
{
    public function __construct(protected string $path, protected ?string $namespace = null)
    {
    }

    /**
     * Casts to string by returning the path only.
     */
    public function __toString(): string
    {
        return $this->path;
    }

    /**
     * Get the namespace
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    /**
     * Get the path
     */
    public function getPath(): string
    {
        return $this->path;
    }
}