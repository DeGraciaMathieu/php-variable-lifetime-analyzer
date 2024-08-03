<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Variable;

class MethodAnalyze
{
    private array $variables = [];

    public function __construct(
        public string $name,
    ) {}

    public function addVariable(Variable $variable): void
    {
        $this->variables[$variable->name()][] = $variable->line();
    }

    public function countVariables(): int
    {
        return count($this->variables);
    }

    public function maxVariablesLifetime(): float
    {
        $max = 0;

        foreach ($this->variables as $variable) {
            $max = max($max, $this->lifetime($variable));
        }

        return $max;
    }

    public function totalVariablesLifetime(): int
    {
        $total = 0;

        foreach ($this->variables as $variable) {
            $total += $this->lifetime($variable);
        }

        return $total;
    }

    public function averageVariableLifetime(): int
    {
        return $this->totalVariablesLifetime() / ($this->countVariables() ?: 1);
    }

    private function lifetime(array $variable): int
    {
        return max($variable) - min($variable);
    }
}
