<?php

declare(strict_types=1);

namespace App\Example2\Tests\Unit;

use App\Example2\WordReverser;
use PHPUnit\Framework\TestCase;

class WordReverserTest extends TestCase
{
    public function testFormat()
    {
        self::assertSame('c b a', (new WordReverser())->reverseWords('a b c'));
        self::assertSame('Carl Bob Ann', (new WordReverser())->reverseWords('Ann Bob Carl'));
    }
}
