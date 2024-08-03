<?php

namespace App\Application;

use App\Domain\Aggregators\AnalyzeAggregator;

class AnalyzeResponse
{
    public function __construct(
        private AnalyzeAggregator $aggregator
    ) {}

    public function averageVariableLifetime(): string
    {
        $lifetime = $this->aggregator->averageLifetime();

        return self::format($lifetime);
    }

    public function averageVariableLifetimePerMethod(): string
    {
        $lifetime = $this->aggregator->averageVariableLifetimePerMethod();

        return self::format($lifetime);
    }

    public function maxVariableLifetime(): string
    {
        $lifetime = $this->aggregator->maxVariableLifetime();

        return self::format($lifetime);
    }

    private static function format(float $number): string
    {
        if ($number === 0.0) {
            return 'NAN';
        }

        return number_format($number, 2);
    }
}
