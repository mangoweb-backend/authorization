<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\AccessNodes;

use Mangoweb\Authorization\AccessEvaluator;
use Mangoweb\Authorization\Action;

interface AccessNode
{

	public function isAllowed(AccessEvaluator $accessEvaluator, Action $action): bool;

}
