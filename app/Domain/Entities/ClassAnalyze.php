<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Analyze;

class ClassAnalyze implements Analyze
{
    private array $methods = [];

    public function __construct(
        private string $name,
    ) {
    }

    public function addMethod(MethodAnalyze $method): void
    {
        $this->methods[$method->name] = $method;
    }

    public function isEmpty(): bool
    {
        return $this->countVariables() === 0;
    }

    public function maxLifetime(): int
    {
        $max = 0;

        foreach ($this->methods as $method) {
            $max = max($max, $method->maxVariablesLifetime());
        }

        return $max;
    }

    public function countVariables(): int
    {
        $total = 0;

        foreach ($this->methods as $method) {
            $total += $method->countVariables();
        }

        return $total;
    }

    public function countMethods(): int
    {
        return count($this->methods);
    }

    public function totalLifetimes(): int
    {
        $total = 0;

        foreach ($this->methods as $method) {
            $total += $method->totalVariablesLifetime();
        }

        return $total;
    }

    public function averageVariableLifetimePerMethod(): float
    {
        $total = 0;

        foreach ($this->methods as $method) {
            $total += $method->averageVariableLifetime();
        }

        return $total / ($this->countMethods() ?? 1);
    }
}
