<?php

namespace App\Domain\ValueObjects;

final readonly class Fqcn
{
    public function __construct(
        public string $value,
    ) {
    }
}
