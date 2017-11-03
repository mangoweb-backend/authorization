<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\AccessNodes;

use Mangoweb\Authorization\AccessEvaluator;
use Mangoweb\Authorization\Action;


class FixedAccessNode implements AccessNode
{

	/** @var bool */
	private $result;


	public function __construct(bool $result)
	{
		$this->result = $result;
	}


	public static function allowed(): self
	{
		return new self(TRUE);
	}


	public static function denied(): self
	{
		return new self(FALSE);
	}


	public function isAllowed(AccessEvaluator $accessEvaluator, Action $action): bool
	{
		return $this->result;
	}

}
