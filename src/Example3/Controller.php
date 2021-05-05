<?php

declare(strict_types=1);

namespace App\Example3;

class Controller
{
    public function __construct(
        private WordReverser $wordReverser,
        private WordNumberer $wordNumberer,
        private string $displayText = 'Good morning, stranger.'
    ) {
    }

    public function getDisplayText(): string
    {
        $this->wordReverser->reverseWords($this->displayText);

        return $this->wordNumberer->numberWords($this->displayText);
    }
}
