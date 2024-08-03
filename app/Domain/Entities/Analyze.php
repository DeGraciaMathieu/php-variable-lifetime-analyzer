<?php

namespace App\Domain\Entities;

interface Analyze
{
    public function isEmpty(): bool;
    public function countVariables(): int;
    public function countMethods(): int;
    public function totalLifetimes(): int;
    public function maxLifetime(): int;
}
