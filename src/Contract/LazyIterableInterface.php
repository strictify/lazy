<?php

declare(strict_types=1);

namespace Strictify\Lazy\Contract;

use IteratorAggregate;

/**
 * @template-covariant T
 *
 * @extends IteratorAggregate<array-key, T>
 */
interface LazyIterableInterface extends IteratorAggregate
{
    /**
     * @return iterable<array-key, T>
     */
    public function getValues(): iterable;

    public function isResolved(): bool;
}
