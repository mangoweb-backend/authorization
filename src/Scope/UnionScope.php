<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Scope;

use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\UnionAccessNode;
use Mangoweb\Authorization\Identity;


class UnionScope implements AuthorizationScope
{

	/** @var AuthorizationScope[] */
	private $scopes;


	public function __construct(AuthorizationScope ...$scopes)
	{
		$this->scopes = $scopes;
	}


	public function getIdentityAccess(Identity $identity): AccessNode
	{
		$nodes = [];
		foreach ($this->scopes as $scope) {
			$nodes[] = $scope->getIdentityAccess($identity);
		}
		return new UnionAccessNode(...$nodes);
	}

}
