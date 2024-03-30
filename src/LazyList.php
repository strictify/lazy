<?php

declare(strict_types=1);

namespace Strictify\Lazy;

use Strictify\Lazy\Contract\AbstractLazyValue;

/**
 * @template T
 *
 * @extends AbstractLazyValue<list<T>>
 */
class LazyList extends AbstractLazyValue
{
    /**
     * @param callable(): list<T> $resolver
     */
    public function __construct(callable $resolver)
    {
        parent::__construct($resolver);
    }
}
