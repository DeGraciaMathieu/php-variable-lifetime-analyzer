<?php

namespace App\Domain\Ports;

use DeGraciaMathieu\RapidBind\Bind;
use App\Domain\DataTransferObjects\Path;
use App\Domain\Aggregators\FileAggregator;
use App\Infrastructure\Repositories\FileRepositoryAdapter;

#[Bind(FileRepositoryAdapter::class)]
interface FileRepository
{
    public function all(Path $path): FileAggregator;
}
