<?php

namespace App\Presenter\Commands;

use App\Application\AnalyzeOutput;
use App\Application\AnalyzeResponse;
use App\Domain\Aggregators\AnalyzeAggregator;
use App\Domain\Aggregators\FileAggregator;

class JsonAnalyzeOutput implements AnalyzeOutput
{
    public function hello(): void
    {
        //
    }

    public function howManyFilesFound(FileAggregator $fileAggregator)
    {
        //
    }

    public function howManyVariablesFound(AnalyzeAggregator $analyzeAggregator)
    {
        //
    }

    public function present(AnalyzeResponse $analyzeResponse): void
    {
        echo json_encode([
            'average_variable_lifetime' => $analyzeResponse->averageVariableLifetime(),
            'average_variable_lifetime_per_method' => $analyzeResponse->averageVariableLifetimePerMethod(),
            'max_variable_lifetime' => $analyzeResponse->maxVariableLifetime(),
        ]);
    }
}
