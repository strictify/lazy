<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Strictify\Lazy\Contract\LazyListInterface;

/**
 * @template-covariant TValue
 *
 * @implements LazyListInterface<TValue>
 */
class ResolvedList implements LazyListInterface
{
    /**
     * @param iterable<array-key, TValue> $resolved
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
