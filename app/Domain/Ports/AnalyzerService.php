<?php

namespace App\Domain\Ports;

use App\Domain\Entities\File;
use App\Domain\Entities\Analyze;
use DeGraciaMathieu\RapidBind\Bind;
use App\Infrastructure\Services\AnalyzerServiceAdapter;

#[Bind(AnalyzerServiceAdapter::class)]
interface AnalyzerService
{
    public function analyze(File $file): Analyze;
}
