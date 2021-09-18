<?php

declare(strict_types=1);

namespace Strictify\Lazy\Contract;

use IteratorAggregate;

/**
 * @template-covariant TValue
 *
 * @extends IteratorAggregate<array-key, TValue>
 */
interface LazyListInterface extends IteratorAggregate
{
    /**
     * @return iterable<array-key, TValue>
     */
    public function getValues(): iterable;

    public function isResolved(): bool;
}
