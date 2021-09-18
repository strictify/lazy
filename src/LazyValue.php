<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Closure;
use Strictify\Lazy\Store\Store;
use Strictify\Lazy\Contract\LazyValueInterface;

/**
 * @template-covariant  T
 *
 * @implements LazyValueInterface<T>
 */
class LazyValue implements LazyValueInterface
{
    /**
     * @var ?Store<T>
     */
    private ?Store $store = null;

    /**
     * @param Closure(): T $callable
     */
    public function __construct(private Closure $callable)
    {
    }

    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    /**
     * @return T
     */
    public function getValue()
    {
        $store = $this->store ??= $this->doGetStore();

        return $store->fetch();
    }

    public function isResolved(): bool
    {
        return (bool)$this->store;
    }

    /**
     * @return Store<T>
     */
    private function doGetStore(): Store
    {
        $callable = $this->callable;
        $value = $callable();

        return new Store($value);
    }
}
