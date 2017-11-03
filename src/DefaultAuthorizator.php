<?php declare(strict_types = 1);

namespace Mangoweb\Authorization;

use Mangoweb\Authorization\AccessNodes\RolesAccessNode;
use Mangoweb\Authorization\AccessNodes\UnionAccessNode;
use Mangoweb\Authorization\Scope\AuthorizationScope;


class DefaultAuthorizator implements Authorizator
{

	/** @var AccessEvaluator */
	private $accessEvaluator;


	public function __construct(AccessEvaluator $accessEvaluator)
	{
		$this->accessEvaluator = $accessEvaluator;
	}


	public function isAllowed(Identity $identity, AuthorizationScope $scope, array $action): bool
	{
		assert(count($action) === 2 && isset($action[0], $action[1]) && is_string($action[0]) && is_string($action[1]));

		$node = $scope->getIdentityAccess($identity);
		$node = new UnionAccessNode(new RolesAccessNode(...$identity->getRoles()), $node);
		return $node->isAllowed($this->accessEvaluator, new Action(...$action));
	}

}
