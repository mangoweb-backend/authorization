<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Bridges\NetteSecurity;

use Mangoweb\Authorization\AccessEvaluator;
use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\RolesAccessNode;
use Mangoweb\Authorization\Action;
use Nette\Security\IAuthorizator;


class NetteAccessEvaluator implements AccessEvaluator
{

	/** @var IAuthorizator */
	private $authorizator;


	public function __construct(IAuthorizator $authorizator)
	{
		$this->authorizator = $authorizator;
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
			if ($this->authorizator->isAllowed($role, $action->getResource(), $action->getPrivilege())) {
				return TRUE;
			}
		}
		return FALSE;
	}

}
