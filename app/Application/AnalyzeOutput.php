<?php

namespace App\Application;

use App\Application\AnalyzeResponse;
use App\Domain\Aggregators\FileAggregator;
use App\Domain\Aggregators\AnalyzeAggregator;

interface AnalyzeOutput
{
    public function hello(): void;
    public function howManyFilesFound(FileAggregator $fileAggregator);
    public function howManyVariablesFound(AnalyzeAggregator $analyzeAggregator);
    public function present(AnalyzeResponse $analyzeResponse);
}
