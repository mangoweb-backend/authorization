<?php declare(strict_types = 1);

namespace Mangoweb\Authorization\Bridges\NetteDI;

use Mangoweb\Authorization\AccessEvaluator;
use Mangoweb\Authorization\Authorizator;
use Mangoweb\Authorization\Bridges\NetteSecurity\NetteAccessEvaluator;
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
		$this->defaults['accessEvaluator'] = interface_exists(IAuthorizator::class) ? NetteAccessEvaluator::class : NULL;
	}


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);
		$builder->addDefinition($this->prefix('authorizator'))
			->setClass(Authorizator::class)
			->setFactory(DefaultAuthorizator::class);


		if ($config['accessEvaluator'] !== NULL) {
			$def = $builder->addDefinition('accessEvaluator')
				->setClass(AccessEvaluator::class);
			Compiler::loadDefinition($def, $config['accessEvaluator']);
		}
	}

}
