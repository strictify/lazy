<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Stringable;
use Strictify\Lazy\Contract\LazyValueInterface;
use Strictify\Lazy\Contract\AbstractResolvable;

/**
 * @template-covariant T
 *
 * @extends AbstractResolvable<T>
 *
 * @implements LazyValueInterface<T>
 */
class LazyValue extends AbstractResolvable implements LazyValueInterface, Stringable
{
    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    public function getValue()
    {
        return $this->getResolvedValue();
    }
}
