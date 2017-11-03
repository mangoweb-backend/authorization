<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\AccessNodes;


interface CompositeAccessNode extends AccessNode
{

	/**
	 * @return AccessNode[]
	 */
	public function getNodes(): array;

}
