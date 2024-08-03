<?php

namespace App\Domain\ValueObjects;

final readonly class Variable
{
    public function __construct(
        private string $name,
        private int $line,
    ) {}

    public function name(): string
    {
        return $this->name;
    }

    public function line(): int
    {
        return $this->line;
    }
}
