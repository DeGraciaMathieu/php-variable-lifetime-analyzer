<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Analyze;

class NullAnalyze implements Analyze
{
    public function isEmpty(): bool
    {
        return true;
    }

    public function countVariables(): int
    {
        return 0;
    }

    public function countMethods(): int
    {
        return 0;
    }

    public function totalLifetimes(): int
    {
        return 0.0;
    }

    public function maxLifetime(): int
    {
        return 0;
    }
}
