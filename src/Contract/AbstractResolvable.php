<?php

declare(strict_types=1);

namespace Strictify\Lazy\Contract;

use Closure;
use Strictify\Lazy\Store\Store;

/**
 * @template-covariant T
 */
abstract class AbstractResolvable
{
    /**
     * @var ?Store<T>
     */
    private ?Store $store = null;

    /**
     * @param Closure(): T $resolver
     */
    public function __construct(private Closure $resolver)
    {
    }

    public function isResolved(): bool
    {
        return (bool)$this->store;
    }

    /**
     * @return T
     */
    public function getResolvedValue()
    {
        $store = $this->store ??= $this->doGetStore();

        return $store->fetch();
    }

    /**
     * @return Store<T>
     */
    private function doGetStore(): Store
    {
        $resolver = $this->resolver;
        $value = $resolver();

        return new Store($value);
    }
}
