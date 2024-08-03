<?php

namespace App\Infrastructure\Factories;

use App\Domain\Entities\File;
use App\Domain\ValueObjects\Fqcn;

class FileFactory
{
    public static function makeFromMap(array $map): array
    {
        $files = array_values($map);

        return array_map(fn($file) => self::make($file), $files);
    }

    public static function make(string $fqcn): File
    {
        return new File(
            new Fqcn($fqcn),
        );
    }
}
