<?php

namespace App\Domain\Ports;

use App\Domain\Entities\File;
use App\Domain\Entities\Analyze;

interface AnalyzerService
{
    public function analyze(File $file): Analyze;
}
