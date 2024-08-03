<?php

namespace App\Infrastructure\Factories;

use PhpParser\Node;
use App\Domain\ValueObjects\Variable;
use App\Infrastructure\Helpers\NodeHelper;

class VariableFactory
{
    public static function make(Node $node): Variable
    {
        return new Variable(
            name: NodeHelper::name($node),
            line: $node->getStartLine(),
        );
    }
}
