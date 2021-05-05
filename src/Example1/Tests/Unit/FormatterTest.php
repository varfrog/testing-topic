<?php

declare(strict_types=1);

namespace App\Example1\Tests\Unit;

use App\Example1\Formatter;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    public function testFormat()
    {
        $formatter = new Formatter();

        self::assertSame('c1 b2 a3', $formatter->format('a b c'));
        self::assertSame('baz1 bar2 foo3', $formatter->format('foo bar baz'));
    }
}
