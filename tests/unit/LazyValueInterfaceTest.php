<?php

declare(strict_types=1);

namespace Strictify\Lazy\Tests;

use Strictify\Lazy\LazyValue;
use PHPUnit\Framework\TestCase;
use Strictify\Lazy\ResolvedValue;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
class LazyValueInterfaceTest extends TestCase
{
    public function testLazyValue(): void
    {
        $lazy = new LazyValue(fn() => 42);
        self::assertFalse($lazy->isResolved());

        self::assertEquals(42, $lazy->getValue());
        self::assertTrue($lazy->isResolved());
    }

    public function testResolvedValue(): void
    {
        $resolved = new ResolvedValue(42);
        self::assertEquals(42, $resolved->getValue());
    }
}
