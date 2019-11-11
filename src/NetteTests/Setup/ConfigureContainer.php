<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Setup;

use Nette\Configurator;
use Nette\DI\Container;
use Nette\SmartObject;
use PHPUnit\Framework\TestCase;

class ConfigureContainer
{

	public const SERVICES_CONFIG = __DIR__ . '/../../../config/services.neon';

	use SmartObject;

	public static function addConfig(Configurator $configurator): void
	{
		$configurator->addConfig(self::SERVICES_CONFIG);
	}

	public function process(Configurator $configurator, TestCase $testCase): Container
	{
		self::addConfig($configurator);
		$container = $configurator->createContainer();
		$setupInjects = $container->getByType(AllowInjects::class);
		$setupInjects->process($container, $testCase);
		return $container;
	}

}
