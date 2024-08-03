<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Ports\FileRepository;
use App\Domain\DataTransferObjects\Path;
use App\Domain\Aggregators\FileAggregator;
use App\Infrastructure\Factories\FileFactory;
use Composer\ClassMapGenerator\ClassMapGenerator;

class FileRepositoryAdapter implements FileRepository
{
    public function all(Path $path): FileAggregator
    {
        $map = ClassMapGenerator::createMap($path->value());

        $files = FileFactory::makeFromMap($map);

        $fileAggregator = app(FileAggregator::class)->addList($files);

        return $fileAggregator;
    }
}
