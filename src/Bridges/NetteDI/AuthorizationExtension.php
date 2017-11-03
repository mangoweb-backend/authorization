<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Bridges\NetteDI;

use Mangoweb\Authorization\Authorizator;
use Mangoweb\Authorization\DefaultAuthorizator;
use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;
use Nette\Security\IAuthorizator;


class AuthorizationExtension extends CompilerExtension
{

	public $defaults = [
		'accessEvaluator' => NULL,
	];


	public function __construct()
	{
		$this->defaults['accessEvaluator'] = class_exists(IAuthorizator::class);
	}


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();
		$builder->addDefinition($this->prefix('authorizator'))
			->setType(Authorizator::class)
			->setFactory(DefaultAuthorizator::class);


		if ($config['accessEvaluator'] !== NULL) {
			$def = $builder->addDefinition('accessEvaluator');
			Compiler::loadDefinition($def, $config['accessEvaluator']);
		}
	}

}
