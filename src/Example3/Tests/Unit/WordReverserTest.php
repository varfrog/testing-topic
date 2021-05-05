<?php

declare(strict_types=1);

namespace App\Example3\Tests\Unit;

use App\Example3\WordReverser;
use PHPUnit\Framework\TestCase;

class WordReverserTest extends TestCase
{
    public function testFormat()
    {
        self::assertSame('c b a', (new WordReverser())->reverseWords('a b c'));
    }
}
