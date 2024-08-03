<?php

namespace App\Application;

use App\Application\AnalyzeInput;
use App\Application\AnalyzeOutput;
use App\Application\AnalyzeResponse;
use App\Domain\Ports\FileRepository;
use App\Domain\Ports\AnalyzerService;

class AnalyzeAction
{
    public function __construct(
        private FileRepository $fileRepository,
        private AnalyzerService $analyzerService,
    ) {}

    public function handle(AnalyzeInput $input, AnalyzeOutput $output): void
    {
        $output->hello();

        $fileAggregator = $this->fileRepository->all($input->path());

        $output->howManyFilesFound($fileAggregator);

        $analyzeAggregator = $fileAggregator->analyze();

        $output->howManyVariablesFound($analyzeAggregator);

        $output->present(new AnalyzeResponse(
            aggregator: $analyzeAggregator
        ));
    }
}
