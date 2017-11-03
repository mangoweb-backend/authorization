<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;

use Mangoweb\Authorization\AccessNodes\FixedAccessNode;
use Mangoweb\Authorization\AccessNodes\IntersectionAccessNode;
use Mangoweb\Authorization\AccessNodes\UnionAccessNode;
use Mangoweb\Authorization\Action;
use Mangoweb\Authorization\Scope\FixedScope;
use Mangoweb\Authorization\Scope\GlobalScope;
use Mangoweb\Authorization\Scope\IntersectionScope;
use Mangoweb\Authorization\Scope\UnionScope;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../../bootstrap.php';


/**
 * @testCase
 */
class AuthorizationScopeTest extends TestCase
{

	public function testFixed()
	{
		$node = FixedAccessNode::allowed();
		$scope = new FixedScope($node);
		Assert::same($node, $scope->getIdentityAccess(new Identity([])));
	}


	public function testIntersection()
	{
		$node1 = FixedAccessNode::allowed();
		$node2 = FixedAccessNode::denied();

		$scope = new IntersectionScope(new FixedScope($node1), new FixedScope($node2));
		$resultNode = $scope->getIdentityAccess(new Identity([]));
		Assert::type(IntersectionAccessNode::class, $resultNode);
		assert($resultNode instanceof IntersectionAccessNode);
		Assert::same([$node1, $node2], $resultNode->getNodes());
	}


	public function testUnion()
	{
		$node1 = FixedAccessNode::allowed();
		$node2 = FixedAccessNode::denied();

		$scope = new UnionScope(new FixedScope($node1), new FixedScope($node2));
		$resultNode = $scope->getIdentityAccess(new Identity([]));
		Assert::type(UnionAccessNode::class, $resultNode);
		assert($resultNode instanceof UnionAccessNode);
		Assert::same([$node1, $node2], $resultNode->getNodes());
	}


	public function testGlobal()
	{
		$scope = new GlobalScope();
		$node = $scope->getIdentityAccess(new Identity([]));
		Assert::type(FixedAccessNode::class, $node);
		Assert::false($node->isAllowed(new DummyAccessEvaluator(), new Action('foo', 'bar')));
	}

}


(new AuthorizationScopeTest())->run();
