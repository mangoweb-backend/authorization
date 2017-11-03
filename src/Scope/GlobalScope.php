<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Scope;

use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\FixedAccessNode;
use Mangoweb\Authorization\Identity;


class GlobalScope implements AuthorizationScope
{

	public function getIdentityAccess(Identity $identity): AccessNode
	{
		return FixedAccessNode::denied();
	}

}
