<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Stringable;
use Strictify\Lazy\Contract\AbstractLazyValue;

/**
 * @extends AbstractLazyValue<string>
 */
class LazyString extends AbstractLazyValue implements Stringable
{
    /**
     * @param callable(): string $resolver
     */
    public function __construct(callable $resolver)
    {
        parent::__construct($resolver);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
