<?php

declare(strict_types=1);

namespace App\Example3\Tests\Unit;

use App\Example3\WordNumberer;
use PHPUnit\Framework\TestCase;

class WordNumbererTest extends TestCase
{
    public function testFormat()
    {
        self::assertSame('a1 b2 c3', (new WordNumberer())->numberWords('a b c'));
    }
}
