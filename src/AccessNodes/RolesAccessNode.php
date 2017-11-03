<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\AccessNodes;

use Mangoweb\Authorization\Action;
use Mangoweb\Authorization\AccessEvaluator;


class RolesAccessNode implements AccessNode
{

	/** @var string[] */
	private $roles;


	public function __construct(string ...$roles)
	{
		$this->roles = $roles;
	}


	public function isAllowed(AccessEvaluator $accessEvaluator, Action $action): bool
	{
		return $accessEvaluator->evaluate($this, $action);
	}


	public function getRoles(): array
	{
		return $this->roles;
	}

}
