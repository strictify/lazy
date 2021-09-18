<?php

declare(strict_types=1);

namespace Strictify\Lazy\Tests;

use Strictify\Lazy\LazyIterable;
use PHPUnit\Framework\TestCase;
use Strictify\Lazy\ResolvedIterable;

class LazyListInterfaceTest extends TestCase
{
    public function testLazyList(): void
    {
        $lazy = new LazyIterable(fn() => [1, 2, 4]);
        self::assertFalse($lazy->isResolved());

        self::assertEquals([1, 2, 4], $lazy->getValues());
        self::assertTrue($lazy->isResolved());
    }

    public function testResolvedValue(): void
    {
        $resolved = new ResolvedIterable([1, 2, 4]);
        self::assertEquals([1, 2, 4], $resolved->getValues());
    }
}
