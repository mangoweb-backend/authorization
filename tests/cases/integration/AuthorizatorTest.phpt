<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;

use Mangoweb\Authorization\DefaultAuthorizator;
use Mangoweb\Authorization\Scope\GlobalScope;
use Mangoweb\Authorization\Scope\IntersectionScope;
use Mangoweb\Authorization\Scope\UnionScope;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../../bootstrap.php';


/**
 * @testCase
 */
class AuthorizatorTest extends TestCase
{

	public function testAuthorizator()
	{
		$evaluator = new DummyAccessEvaluator();
		$authorizator = new DefaultAuthorizator($evaluator);

		$admin = new Identity([Identity::ROLE_ALLOWED]);
		$articleAuthor = new Identity([]);
		$article = new Article($articleAuthor);

		$commentAuthor = new Identity([]);
		$comment = new Comment($commentAuthor, $article);

		$comment2Author = new Identity([]);
		$comment2 = new Comment($comment2Author, $article);

		$passerby = new Identity([]);

		$action = ['foo', 'bar'];

		Assert::true($authorizator->isAllowed($admin, new GlobalScope(), $action));
		Assert::true($authorizator->isAllowed($admin, $article, $action));
		Assert::true($authorizator->isAllowed($admin, $comment, $action));

		Assert::false($authorizator->isAllowed($articleAuthor, new GlobalScope(), $action));
		Assert::true($authorizator->isAllowed($articleAuthor, $article, $action));
		Assert::true($authorizator->isAllowed($articleAuthor, $comment, $action));
		Assert::true($authorizator->isAllowed($articleAuthor, $comment2, $action));
		Assert::true($authorizator->isAllowed($articleAuthor, new IntersectionScope($comment, $comment2), $action));

		Assert::false($authorizator->isAllowed($commentAuthor, new GlobalScope(), $action));
		Assert::false($authorizator->isAllowed($commentAuthor, $article, $action));
		Assert::true($authorizator->isAllowed($commentAuthor, $comment, $action));
		Assert::false($authorizator->isAllowed($commentAuthor, new IntersectionScope($comment, $comment2), $action));
		Assert::true($authorizator->isAllowed($commentAuthor, new UnionScope($comment, $comment2), $action));

		Assert::false($authorizator->isAllowed($passerby, new GlobalScope(), $action));
		Assert::false($authorizator->isAllowed($passerby, $article, $action));
		Assert::false($authorizator->isAllowed($passerby, $comment, $action));
	}

}


(new AuthorizatorTest())->run();
