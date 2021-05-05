<?php

declare(strict_types=1);

namespace App\Example2;

class WordNumberer
{
    public function numberWords(string $text): string
    {
        $words = explode(' ', $text);
        $resultParts = [];
        for ($j = 0; $j < count($words); $j++) {
            $resultParts[] = $words[$j] . ($j + 1);
        }

        return join(' ', $resultParts);
    }
}
