<?php declare(strict_types = 1);

namespace Mangoweb\Authorization;

use Mangoweb\Authorization\Scope\AuthorizationScope;


interface Authorizator
{

	/**
	 * @param Identity           $identity
	 * @param AuthorizationScope $scope
	 * @param array              $action pair [string $resource, string $privilege]
	 * @return bool
	 */
	public function isAllowed(Identity $identity, AuthorizationScope $scope, array $action): bool;

}
