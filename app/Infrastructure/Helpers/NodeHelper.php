<?php

namespace App\Infrastructure\Helpers;

use PhpParser\Node;
use PhpParser\Node\Expr\PropertyFetch;

class NodeHelper
{
    public static function name(Node $node): string
    {
        $name = $node->name;

        if ($name instanceof PropertyFetch) {
            return $name->name;
        }

        return $name;
    }
}
