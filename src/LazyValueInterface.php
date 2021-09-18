<?php

declare(strict_types=1);

namespace Strictify\Lazy;

/**
 * @template-covariant  T
 */
interface LazyValueInterface
{
    /**
     * @return T
     */
    public function getValue();

    public function isResolved(): bool;
}
