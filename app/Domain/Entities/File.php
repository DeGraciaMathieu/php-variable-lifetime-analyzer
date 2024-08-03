<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Fqcn;

class File
{
    public function __construct(
        private Fqcn $fqcn,
    ) {}

    public function content(): string
    {
        return file_get_contents($this->fqcn->value);
    }
}
