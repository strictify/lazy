<?php

declare(strict_types=1);

namespace Strictify\Lazy\Contract;

use Closure;
use Strictify\Lazy\Store\Store;

/**
 * @template-covariant T
 */
abstract class AbstractLazy
{
    /**
     * @var ?Store<T>
     */
    private ?Store $store = null;

    public function isResolved(): bool
    {
        return (bool)$this->store;
    }

    /**
     * @return Closure(): T
     */
    abstract protected function getResolver(): Closure;

    /**
     * @return T
     */
    protected function getResolvedValue()
    {
        $store = $this->store ??= $this->doGetStore();

        return $store->fetch();
    }

    /**
     * @return Store<T>
     */
    private function doGetStore(): Store
    {
        $callable = $this->getResolver();
        $value = $callable();

        return new Store($value);
    }
}
