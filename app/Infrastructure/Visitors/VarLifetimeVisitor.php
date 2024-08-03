<?php

namespace App\Infrastructure\Visitors;

use App\Infrastructure\Helpers\NodeHelper;
use PhpParser\Node;
use PhpParser\NodeVisitor;
use PhpParser\Node\Stmt\Enum_;
use App\Domain\Entities\Analyze;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\Interface_;
use App\Domain\Entities\NullAnalyze;
use PhpParser\Node\Stmt\ClassMethod;
use App\Domain\Entities\ClassAnalyze;
use App\Domain\Entities\MethodAnalyze;
use App\Infrastructure\Factories\VariableFactory;

class VarLifetimeVisitor extends NodeVisitorAbstract
{
    private $classAnalyze;
    private $methodAnalyze;
    private array $variables = [];

    public function enterNode(Node $node)
    {
        if (self::nodeAreUnprocessable($node)) {
            return NodeVisitor::DONT_TRAVERSE_CURRENT_AND_CHILDREN;
        }

        if ($node instanceof ClassLike) {
            $this->classAnalyze = new ClassAnalyze($node->name->name);
        }

        if ($node instanceof ClassMethod) {
            $this->methodAnalyze = new MethodAnalyze($node->name->name);
        }

        if ($this->isMethodVariable($node)) {

            $variable = VariableFactory::make($node);

            $this->methodAnalyze->addVariable($variable);
        }
    }

    public static function nodeAreUnprocessable(Node $node): bool
    {
        return $node instanceof Interface_ || $node instanceof Enum_;
    }

    public function leaveNode(Node $node)
    {
        if ($node instanceof ClassMethod) {

            $this->classAnalyze->addMethod($this->methodAnalyze);

            $this->methodAnalyze = null;
        }
    }

    public function getAnalyze(): Analyze
    {
        return $this->classAnalyze ?? new NullAnalyze();
    }

    private function isMethodVariable(Node $node): bool
    {
        return $node instanceof Variable && $this->methodAnalyze;
    }
}
