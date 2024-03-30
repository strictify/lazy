<?php

declare(strict_types=1);

namespace Strictify\Lazy\Store;

/**
 * This should not be used outside LazyValue class.
 *
 * @template  T
 *
 * @internal
 * @psalm-internal Strictify\Lazy
 */
class Store
{
    /**
     * @param T $value
     */
    public function __construct(
        private $value,
    )
    {
    }

    /**
     * @return T
     */
    public function fetch()
    {
        return $this->value;
    }
}
