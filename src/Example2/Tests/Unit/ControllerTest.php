<?php

declare(strict_types=1);

namespace App\Example2\Tests\Unit;

use App\Example2\Controller;
use App\Example2\WordNumberer;
use App\Example2\WordReverser;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testDisplayText()
    {
        $wordReverser = self::createMock(WordReverser::class);
        $wordReverser
            ->expects(self::any())
            ->method('reverseWords')
            ->willReturn('there hello')
        ;

        $wordNumberer = self::createMock(WordNumberer::class);
        $wordNumberer
            ->expects(self::any())
            ->method('numberWords')
            ->willReturn('there1 hello2')
        ;

        $controller = new Controller($wordReverser, $wordNumberer, 'hello there');

        self::assertSame('there1 hello2', $controller->getDisplayText());
    }
}
