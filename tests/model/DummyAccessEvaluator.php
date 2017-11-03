<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;

use Mangoweb\Authorization\AccessEvaluator;
use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\RolesAccessNode;
use Mangoweb\Authorization\Action;

class DummyAccessEvaluator implements AccessEvaluator
{

	public function evaluate(AccessNode $accessNode, Action $action): bool
	{
		if ($accessNode instanceof RolesAccessNode) {
			foreach ($accessNode->getRoles() as $role) {
				return $role === Identity::ROLE_ALLOWED ? TRUE : FALSE;
			}
			return FALSE;
		}
		throw new \LogicException();
	}

}
