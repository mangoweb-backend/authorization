<?php declare(strict_types = 1);

namespace Mangoweb\Authorization;

use Mangoweb\Authorization\AccessNodes\AccessNode;


interface AccessEvaluator
{

	public function evaluate(AccessNode $accessNode, Action $action): bool;

}
