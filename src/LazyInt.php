<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Stringable;
use Strictify\Lazy\Contract\AbstractLazyValue;
use function number_format;

/**
 * @extends AbstractLazyValue<int>
 */
class LazyInt extends AbstractLazyValue implements Stringable
{
    /**
     * @param callable(): int $resolver
     */
    public function __construct(callable $resolver, private int $decimals = 2)
    {
        parent::__construct($resolver);
    }

    public function __toString(): string
    {
        return number_format($this->getValue(), $this->decimals);
    }
}
