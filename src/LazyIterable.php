<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Closure;
use Strictify\Lazy\Contract\AbstractResolvable;
use Strictify\Lazy\Contract\LazyIterableInterface;

/**
 * @template-covariant T
 *
 * @extends AbstractResolvable<iterable<array-key, T>>
 *
 * @implements LazyIterableInterface<T>
 */
class LazyIterable extends AbstractResolvable implements LazyIterableInterface
{
    /**
     * @param Closure(): iterable<array-key, T> $resolver
     *
     * @noinspection SenselessProxyMethodInspection : bug in psalm
     */
    public function __construct(Closure $resolver)
    {
        parent::__construct($resolver);
    }

    public function getValues(): iterable
    {
        return $this->getResolvedValue();
    }

    public function getIterator(): iterable
    {
        yield from $this->getValues();
    }
}
