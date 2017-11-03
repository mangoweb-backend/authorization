<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;

use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\FixedAccessNode;
use Mangoweb\Authorization\Identity;
use Mangoweb\Authorization\Scope\AuthorizationScope;

class Article implements AuthorizationScope
{

	private $author;


	public function __construct(Identity $author)
	{
		$this->author = $author;
	}


	public function getAuthor(): Identity
	{
		return $this->author;
	}


	public function getIdentityAccess(Identity $identity): AccessNode
	{
		return new FixedAccessNode($this->author === $identity);
	}

}
