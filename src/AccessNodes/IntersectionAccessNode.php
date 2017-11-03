<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\AccessNodes;

use Mangoweb\Authorization\Action;
use Mangoweb\Authorization\AccessEvaluator;


class IntersectionAccessNode implements CompositeAccessNode
{

	/** @var AccessNode[] */
	private $nodes;


	public function __construct(AccessNode ...$nodes)
	{
		$this->nodes = $nodes;
	}


	public function isAllowed(AccessEvaluator $accessEvaluator, Action $action): bool
	{
		if (count($this->nodes) === 0) {
			return FALSE;
		}
		foreach ($this->nodes as $node) {
			if (!$node->isAllowed($accessEvaluator, $action)) {
				return FALSE;
			}
		}
		return TRUE;
	}


	public function getNodes(): array
	{
		return $this->nodes;
	}

}
