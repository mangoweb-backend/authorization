<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;

use Mangoweb\Authorization\AccessNodes\AccessNode;
use Mangoweb\Authorization\AccessNodes\FixedAccessNode;
use Mangoweb\Authorization\AccessNodes\IntersectionAccessNode;
use Mangoweb\Authorization\AccessNodes\NegateAccessNode;
use Mangoweb\Authorization\AccessNodes\RolesAccessNode;
use Mangoweb\Authorization\AccessNodes\UnionAccessNode;
use Mangoweb\Authorization\Action;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../../bootstrap.php';


/**
 * @testCase
 */
class AccessNodesTest extends TestCase
{

	/**
	 * @dataProvider getTestData
	 */
	public function testNodes(AccessNode $node, bool $result)
	{
		Assert::same($result, $node->isAllowed(new DummyAccessEvaluator(), new Action('foo', 'bar')));
	}


	public function getTestData()
	{
		yield [FixedAccessNode::allowed(), TRUE];
		yield [FixedAccessNode::denied(), FALSE];
		yield [new UnionAccessNode(FixedAccessNode::allowed(), FixedAccessNode::denied()), TRUE];
		yield [new IntersectionAccessNode(FixedAccessNode::allowed(), FixedAccessNode::denied()), FALSE];
		yield [new NegateAccessNode(FixedAccessNode::allowed()), FALSE];
		yield [new RolesAccessNode(Identity::ROLE_ALLOWED), TRUE];
		yield [new RolesAccessNode(Identity::ROLE_DISALLOWED), FALSE];
	}

}


(new AccessNodesTest())->run();
