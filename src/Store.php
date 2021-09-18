<?php

declare(strict_types=1);

namespace Strictify\Lazy;

/**
 * This should not be used outside of LazyValue class.
 *
 * @template-covariant  T
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
    public function getValue()
    {
        return $this->value;
    }
}
