<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Closure;
use Strictify\Lazy\Contract\AbstractLazy;
use Strictify\Lazy\Contract\LazyIterableInterface;

/**
 * @template-covariant T
 *
 * @extends AbstractLazy<iterable<array-key, T>>
 *
 * @implements LazyIterableInterface<T>
 */
class LazyIterable extends AbstractLazy implements LazyIterableInterface
{
    /**
     * @param Closure(): iterable<array-key, T> $resolver
     */
    public function __construct(private Closure $resolver)
    {
    }

    public function getValues(): iterable
    {
        return $this->getResolvedValue();
    }

    public function getIterator(): iterable
    {
        yield from $this->getValues();
    }

    protected function getResolver(): Closure
    {
        return $this->resolver;
    }
}
