<?php

namespace App\Presenter\Commands;

use App\Application\AnalyzeInput;
use App\Application\AnalyzeAction;
use App\Application\AnalyzeOutput;
use LaravelZero\Framework\Commands\Command;

class AnalyzeCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'analyze {path} {--json}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Analyze variable lifetime';

    /**
     * Execute the console command.
     */
    public function handle(AnalyzeAction $action)
    {
        $input = $this->makeInput();
        $output = $this->makeOutput();

        $action->handle($input, $output);
    }

    private function makeInput(): AnalyzeInput
    {
        return new AnalyzeInput(
            path: $this->argument('path'),
        );
    }

    private function makeOutput(): AnalyzeOutput
    {
        return $this->option('json')
            ? new JsonAnalyzeOutput()
            : new TerminalAnalyzeOutput();
    }
}
