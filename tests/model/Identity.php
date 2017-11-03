<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;


class Identity implements \Mangoweb\Authorization\Identity
{
	const ROLE_ALLOWED = 'allowed';
	const ROLE_DISALLOWED = 'disallowed';

	/** @var array */
	private $roles;


	public function __construct(array $roles)
	{
		$this->roles = $roles;
	}


	public function getRoles(): array
	{
		return $this->roles;
	}

}
