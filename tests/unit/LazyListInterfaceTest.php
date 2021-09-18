<?php

declare(strict_types=1);

namespace Strictify\Lazy\Tests;

use Strictify\Lazy\LazyList;
use PHPUnit\Framework\TestCase;
use Strictify\Lazy\ResolvedList;

class LazyListInterfaceTest extends TestCase
{
    public function testLazyList(): void
    {
        $lazy = new LazyList(fn() => [1, 2, 4]);
        self::assertFalse($lazy->isResolved());

        self::assertEquals([1, 2, 4], $lazy->getValues());
        self::assertTrue($lazy->isResolved());
    }

    public function testResolvedValue(): void
    {
        $resolved = new ResolvedList([1, 2, 4]);
        self::assertEquals([1, 2, 4], $resolved->getValues());
    }
}
