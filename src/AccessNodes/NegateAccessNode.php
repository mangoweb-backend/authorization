<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\AccessNodes;

use Mangoweb\Authorization\Action;
use Mangoweb\Authorization\AccessEvaluator;


class NegateAccessNode implements AccessNode
{

	/** @var AccessNode */
	private $innerNode;


	public function __construct(AccessNode $innerNode)
	{
		$this->innerNode = $innerNode;
	}


	public function isAllowed(AccessEvaluator $accessEvaluator, Action $action): bool
	{
		return !$this->innerNode->isAllowed($accessEvaluator, $action);
	}

}
