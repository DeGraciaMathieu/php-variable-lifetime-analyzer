<?php

namespace App\Domain\Ports;

use App\Domain\DataTransferObjects\Path;
use App\Domain\Aggregators\FileAggregator;

interface FileRepository
{
    public function all(Path $path): FileAggregator;
}
