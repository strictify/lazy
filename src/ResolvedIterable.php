<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Strictify\Lazy\Contract\LazyIterableInterface;

/**
 * @template-covariant T
 *
 * @implements LazyIterableInterface<T>
 */
class ResolvedIterable implements LazyIterableInterface
{
    /**
     * @param iterable<array-key, T> $resolved
     */
    public function __construct(private $resolved)
    {
    }

    public function getValues(): iterable
    {
        return $this->resolved;
    }

    public function getIterator(): iterable
    {
        yield from $this->getValues();
    }

    public function isResolved(): bool
    {
        return true;
    }
}
