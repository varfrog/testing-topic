<?php

declare(strict_types=1);

namespace App\Example1;

class Controller
{
    public function __construct(private Formatter $formatter, private string $displayText = 'Good morning, stranger.')
    {
    }

    public function getDisplayText(): string
    {
        return $this->formatter->format($this->displayText);
    }
}
