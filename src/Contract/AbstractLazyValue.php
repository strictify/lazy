<?php

declare(strict_types=1);

namespace Strictify\Lazy\Contract;

use Strictify\Lazy\Store\Store;

/**
 * @template T
 *
 * @implements LazyValueInterface<T>
 */
abstract class AbstractLazyValue implements LazyValueInterface
{
    /**
     * @var ?Store<T>
     */
    private ?Store $store = null;

    /**
     * @param callable(): T $resolver
     *
     * @noinspection PhpMissingParamTypeInspection  https://wiki.php.net/rfc/constructor_promotion#constraints - `callable` cannot be typehinted in promoted properties
     */
    public function __construct(private $resolver)
    {
    }

    public function isResolved(): bool
    {
        return (bool)$this->store;
    }

    /**
     * @return T
     */
    public function getValue()
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
