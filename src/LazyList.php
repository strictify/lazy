<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Closure;
use Strictify\Lazy\Store\Store;
use Strictify\Lazy\Contract\LazyListInterface;

/**
 * @template-covariant TValue
 *
 * @implements LazyListInterface<TValue>
 */
class LazyList implements LazyListInterface
{
    /**
     * @var ?Store<iterable<array-key, TValue>>
     */
    private ?Store $store = null;

    /**
     * @param Closure(): iterable<array-key, TValue> $callable
     */
    public function __construct(private Closure $callable)
    {
    }

    public function getIterator(): iterable
    {
        yield from $this->getValues();
    }

    public function getValues(): iterable
    {
        $store = $this->store ??= $this->doGetStore();

        return $store->fetch();
    }

    public function isResolved(): bool
    {
        return (bool)$this->store;
    }

    /**
     * @return Store<iterable<array-key, TValue>>
     */
    private function doGetStore(): Store
    {
        $callable = $this->callable;
        $value = $callable();

        return new Store($value);
    }
}
