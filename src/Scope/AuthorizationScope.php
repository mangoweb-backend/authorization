<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Scope;

use Mangoweb\Authorization\Identity;
use Mangoweb\Authorization\AccessNodes\AccessNode;


interface AuthorizationScope
{

	public function getIdentityAccess(Identity $identity): AccessNode;

}
