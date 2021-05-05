<?php

declare(strict_types=1);

namespace App\Example3\Tests\Integration;

use App\Example3\Controller;
use App\Example3\WordNumberer;
use App\Example3\WordReverser;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testDisplayText()
    {
        $controller = new Controller(new WordReverser(), new WordNumberer(), 'hello there');

        self::assertSame('there1 hello2', $controller->getDisplayText());
    }
}
