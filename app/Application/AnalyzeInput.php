<?php

namespace App\Application;

use App\Domain\DataTransferObjects\Path;

class AnalyzeInput
{
    public function __construct(
        private string $path,
    ) {}

    public function path(): Path
    {
        return new Path($this->path);
    }
}
