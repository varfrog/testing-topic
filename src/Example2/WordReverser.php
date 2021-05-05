<?php

declare(strict_types=1);

namespace App\Example2;

class WordReverser
{
    public function reverseWords(string $text): string
    {
        $words = explode(' ', $text);
        $reverseParts = [];
        for ($i = count($words) - 1; $i >= 0; $i--) {
            $reverseParts[] = $words[$i];
        }

        return join(' ', $reverseParts);
    }
}
