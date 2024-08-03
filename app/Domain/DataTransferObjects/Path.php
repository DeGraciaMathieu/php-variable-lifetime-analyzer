<?php

namespace App\Domain\DataTransferObjects;

final readonly class Path
{
    public function __construct(
        private string $value,
    ) {}

    public function value(): string
    {
        return $this->value;
    }
}
