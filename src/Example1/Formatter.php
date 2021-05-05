<?php

declare(strict_types=1);

namespace App\Example1;

class Formatter
{
    public function format(string $text): string
    {
        $words = explode(' ', $text);
        $reverseParts = [];
        for ($i = count($words) - 1; $i >= 0; $i--) {
            $reverseParts[] = $words[$i];
        }

        $resultParts = [];
        for ($i = 0; $i < count($reverseParts); $i++) {
            $resultParts[] = $reverseParts[$i] . ($i + 1);
        }

        return join(' ', $resultParts);
    }
}
