<?php

namespace Common\Service;

class Console {

    public function printFormatted( string $value, int $length = 20): void
    {
        echo str_pad($value, $length);
    }

    public function printLine( string $value, int $length = 20): void
    {
        echo str_repeat($value, $length);    
    }

    public function newLine(): void
    {
        echo "\n";
    }
}