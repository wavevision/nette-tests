<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Setup;

use Nette\Configurator;
use Nette\DI\Container;
use Nette\SmartObject;
use PHPUnit\Framework\TestCase;

class ConfigureContainer
{

	public const SERVICES_CONFIG = __DIR__ . '/../../config/services.neon';

	use SmartObject;

	public function process(Configurator $configurator, TestCase $testCase): Container
	{
		$configurator->addConfig(self::SERVICES_CONFIG);
		$container = $configurator->createContainer();
		/** @var AllowInjects $setupInjects */
		$setupInjects = $container->getByType(AllowInjects::class);
		$setupInjects->process($container, $testCase);
		return $container;
	}
}
