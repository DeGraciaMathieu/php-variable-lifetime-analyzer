<?php

namespace App\Presenter\Commands;

use App\Application\AnalyzeOutput;
use App\Application\AnalyzeResponse;
use App\Domain\Aggregators\AnalyzeAggregator;
use App\Domain\Aggregators\FileAggregator;
use function Laravel\Prompts\note;
use function Laravel\Prompts\table;

class TerminalAnalyzeOutput implements AnalyzeOutput
{
    public function hello(): void
    {
        note('❀ PHP Var Lifetime Analyzer ❀');
    }

    public function howManyFilesFound(FileAggregator $fileAggregator)
    {
        $count = $fileAggregator->count();

        note($count . ' files found.');
    }

    public function howManyVariablesFound(AnalyzeAggregator $analyzeAggregator)
    {
        $count = $analyzeAggregator->countVariables();

        note($count . ' variables found.');
    }

    public function present(AnalyzeResponse $analyzeResponse): void
    {
        table(
            headers: [
                'Average variable lifetime', 
                'Average variable lifetime per method',
                'Max variable lifetime',
            ],
            rows: [
                [
                    $analyzeResponse->averageVariableLifetime(),
                    $analyzeResponse->averageVariableLifetimePerMethod(),
                    $analyzeResponse->maxVariableLifetime(),
                ],
            ]
        );
    }
}
