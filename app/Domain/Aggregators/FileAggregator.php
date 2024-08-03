<?php

namespace App\Domain\Aggregators;

use App\Domain\Entities\File;
use App\Domain\Ports\AnalyzerService;

class FileAggregator
{
    public array $files = [];

    public function __construct(
        private AnalyzerService $analyzerService,
        private AnalyzeAggregator $analyzeAggregator,
    ) {}

    public function add(File $file): self
    {
        $this->files[] = $file;

        return $this;
    }

    public function addList(array $files): self
    {
        array_map(fn($file) => $this->add($file), $files);

        return $this;
    }

    public function count(): int
    {
        return count($this->files);
    }

    public function analyze(): AnalyzeAggregator
    {
        $analyzeAggregator = clone $this->analyzeAggregator;

        foreach ($this->files as $file) {

            $classAnalyze = $this->analyzerService->analyze($file);

            $analyzeAggregator->add($classAnalyze);
        }

        return $analyzeAggregator;
    }
}
