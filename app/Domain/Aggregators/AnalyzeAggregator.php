<?php

namespace App\Domain\Aggregators;

use App\Domain\Entities\Analyze;

class AnalyzeAggregator
{
    private array $classAnalyzes = [];
    private int $variablesCount = 0;
    private int $methodCount = 0;
    private int $totalLifetimes = 0;
    private int $maxVariableLifetime = 0;

    public function add(Analyze $classAnalyze): self
    {
        if (! $classAnalyze->isEmpty()) {
            $this->ingest($classAnalyze);
        }

        return $this;
    }

    private function ingest(Analyze $classAnalyze): void
    {
        $this->classAnalyzes[] = $classAnalyze;

        $this->variablesCount += $classAnalyze->countVariables();

        $this->methodCount += $classAnalyze->countMethods();

        $this->totalLifetimes += $classAnalyze->totalLifetimes();

        $this->refreshMaxLifetime($classAnalyze);
    }

    public function countClass(): int
    {
        return count($this->classAnalyzes);
    }

    public function countVariables(): int
    {
        return $this->variablesCount;
    }

    public function averageLifetime(): float
    {
        return $this->totalLifetimes / ($this->countVariables() ?: 1);
    }

    public function maxVariableLifetime(): int
    {
        return $this->maxVariableLifetime;
    }

    public function averageVariableLifetimePerMethod(): float
    {
        $lifetime = 0;

        foreach ($this->classAnalyzes as $classAnalyze) {
            $lifetime += $classAnalyze->averageVariableLifetimePerMethod();
        }

        return $lifetime / ($this->countClass() ?: 1);
    }

    private function refreshMaxLifetime(Analyze $classAnalyze): void
    {
        $classMaxLifetime = $classAnalyze->maxLifetime();

        if ($classMaxLifetime > $this->maxVariableLifetime) {
            $this->maxVariableLifetime = $classMaxLifetime;
        }
    }
}
