<?php

declare(strict_types=1);

namespace Strictify\Lazy\Tests;

use Strictify\Lazy\LazyInt;
use Strictify\Lazy\LazyList;
use Strictify\Lazy\LazyValue;
use Strictify\Lazy\LazyFloat;
use Strictify\Lazy\LazyString;
use PHPUnit\Framework\TestCase;
use Strictify\Lazy\ResolvedValue;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
class LazyValueInterfaceTest extends TestCase
{
    /**
     * @covers \Strictify\Lazy\LazyValue
     */
    public function testLazyValue(): void
    {
        $lazy = new LazyValue(fn() => 42);

        self::assertFalse($lazy->isResolved());

        self::assertEquals(42, $lazy->getValue());
        self::assertTrue($lazy->isResolved());
    }

    /**
     * @covers \Strictify\Lazy\LazyInt
     */
    public function testLazyInt(): void
    {
        $lazy = new LazyInt(fn() => 42);
        self::assertFalse($lazy->isResolved());

        self::assertEquals(42, $lazy->getValue());
        self::assertTrue($lazy->isResolved());
    }

    /**
     * @covers \Strictify\Lazy\LazyFloat
     */
    public function testLazyFloat(): void
    {
        $lazy = new LazyFloat(fn() => 42.73);
        self::assertFalse($lazy->isResolved());

        self::assertEquals(42.73, $lazy->getValue());
        self::assertTrue($lazy->isResolved());
    }

    /**
     * @covers \Strictify\Lazy\LazyString
     */
    public function testLazyString(): void
    {
        $lazy = new LazyString(fn() => '42');
        self::assertFalse($lazy->isResolved());

        self::assertEquals('42', $lazy->getValue());
        self::assertTrue($lazy->isResolved());
    }

    /**
     * @covers \Strictify\Lazy\LazyList
     */
    public function testLazyList(): void
    {
        $lazy = new LazyList(fn() => [42, 73]);
        self::assertFalse($lazy->isResolved());

        self::assertEquals([42, 73], $lazy->getValue());
        self::assertTrue($lazy->isResolved());
    }

    /**
     * @covers \Strictify\Lazy\ResolvedValue
     */
    public function testResolvedValue(): void
    {
        $resolved = new ResolvedValue(42);
        self::assertTrue($resolved->isResolved());
        self::assertEquals(42, $resolved->getValue());
    }
}
