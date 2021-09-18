<?php

declare(strict_types=1);

namespace Strictify\Lazy\Tests;

use Strictify\Lazy\LazyValue;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertTrue;

class LazyValueTest extends TestCase
{
    public function testValueFetch(): void
    {
        $lazy = new LazyValue(fn() => 42);
        self::assertFalse($lazy->isResolved());

        $value = $lazy->getValue();
        self::assertEquals(42, $value);
        assertTrue($lazy->isResolved());
    }
}

