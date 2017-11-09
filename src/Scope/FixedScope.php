<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Scope;

use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\Identity;


class FixedScope implements AuthorizationScope
{

	/** @var AccessNode */
	private $node;


	public function __construct(AccessNode $node)
	{
		$this->node = $node;
	}


	public function getIdentityAccess(Identity $identity): AccessNode
	{
		return $this->node;
	}

}
