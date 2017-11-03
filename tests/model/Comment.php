<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;

use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\FixedAccessNode;
use Mangoweb\Authorization\AccessNodes\UnionAccessNode;
use Mangoweb\Authorization\Identity;
use Mangoweb\Authorization\Scope\AuthorizationScope;

class Comment implements AuthorizationScope
{

	/** @var Identity */
	private $author;

	/** @var Article */
	private $article;


	public function __construct(Identity $author, Article $article)
	{
		$this->author = $author;
		$this->article = $article;
	}


	public function getIdentityAccess(Identity $identity): AccessNode
	{
		return new UnionAccessNode(new FixedAccessNode($this->author === $identity), $this->article->getIdentityAccess($identity));
	}

}
