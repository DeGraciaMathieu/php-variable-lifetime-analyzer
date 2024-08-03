<?php

namespace App\Infrastructure\Services;

use PhpParser\Parser;
use PhpParser\NodeTraverser;
use App\Domain\Entities\File;
use App\Domain\Entities\Analyze;
use App\Domain\Ports\AnalyzerService;
use App\Infrastructure\Visitors\VarLifetimeVisitor;

class AnalyzerServiceAdapter implements AnalyzerService
{
    public function __construct(
        private Parser $parser,
    ){}

    public function analyze(File $file): Analyze
    {
        $ast = $this->parser->parse($file->content());

        $classAnalyze = $this->traverse($ast);

        return $classAnalyze;
    }

    private function traverse(array $ast): Analyze
    {
        $traverser = new NodeTraverser();

        $visitor = new VarLifetimeVisitor();

        $traverser->addVisitor($visitor);

        $traverser->traverse($ast);

        return $visitor->getAnalyze();
    }
}
