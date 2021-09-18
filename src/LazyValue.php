<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Closure;
use Stringable;
use Strictify\Lazy\Contract\AbstractLazy;
use Strictify\Lazy\Contract\LazyValueInterface;

/**
 * @template-covariant T
 *
 * @extends AbstractLazy<T>
 *
 * @implements LazyValueInterface<T>
 */
class LazyValue extends AbstractLazy implements LazyValueInterface, Stringable
{
    /**
     * @param Closure(): T $resolver
     */
    public function __construct(private Closure $resolver)
    {
    }

    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    public function getValue()
    {
        return $this->getResolvedValue();
    }

    protected function getResolver(): Closure
    {
        return $this->resolver;
    }
}
