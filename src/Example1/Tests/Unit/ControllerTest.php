<?php

declare(strict_types=1);

namespace App\Example1\Tests\Unit;

use App\Example1\Controller;
use App\Example1\Formatter;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testDisplayText()
    {
        $formatter = self::createMock(Formatter::class);
        $formatter
            ->expects(self::any())
            ->method('format')
            ->willReturn('there1 hello2')
        ;

        $controller = new Controller($formatter, 'hello there');

        self::assertSame('there1 hello2', $controller->getDisplayText());
    }
}
