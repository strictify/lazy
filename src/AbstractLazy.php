<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Closure;

/**
 * @template-covariant  T
 */
abstract class AbstractLazy implements LazyValueInterface
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

    /**
     * @return T
     */
    public function getValue()
    {
        $store = $this->store ??= $this->doGetStore();

        return $store->getValue();
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
