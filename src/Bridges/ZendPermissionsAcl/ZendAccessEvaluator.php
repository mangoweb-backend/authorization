<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Bridges\ZendPermissionsAcl;

use Mangoweb\Authorization\AccessEvaluator;
use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\RolesAccessNode;
use Mangoweb\Authorization\Action;
use Zend\Permissions\Acl\Acl;


class ZendAccessEvaluator implements AccessEvaluator
{

	/** @var Acl */
	private $acl;


	public function __construct(Acl $acl)
	{
		$this->acl = $acl;
	}


	public function evaluate(AccessNode $accessNode, Action $action): bool
	{
		if ($accessNode instanceof RolesAccessNode) {
			return $this->evaluateRolesAccessNode($accessNode, $action);
		}
		throw new \LogicException();
	}


	private function evaluateRolesAccessNode(RolesAccessNode $accessNode, Action $action): bool
	{
		foreach ($accessNode->getRoles() as $role) {
			if ($this->acl->isAllowed($role, $action->getResource(), $action->getPrivilege())) {
				return TRUE;
			}
		}
		return FALSE;
	}

}
