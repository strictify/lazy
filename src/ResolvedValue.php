<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Strictify\Lazy\Contract\LazyValueInterface;

/**
 * @template T
 *
 * @implements LazyValueInterface<T>
 */
class ResolvedValue implements LazyValueInterface
{
    /**
     * @param T $value
     */
    public function __construct(private $value)
    {
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isResolved(): bool
    {
        return true;
    }
}
