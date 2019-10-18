<?php declare(strict_types = 1);

namespace Wavevision\NetteTests;

use Nette\Configurator;
use PHPUnit\Framework\TestCase;

class Configuration
{

	/**
	 * @var callable
	 */
	private static $configuratorFactory;

	public static function setup(callable $configuratorFactory): void
	{
		ob_start();
		self::$configuratorFactory = $configuratorFactory;
	}

	public static function createConfigurator(TestCase $testCase): Configurator
	{
		$configuratorFactory = self::$configuratorFactory;
		if (!is_callable($configuratorFactory)) {
			throw new InvalidState(
				sprintf(
					"Setup method not called. Call '%s::setup()' method in bootstrap file.",
					self::class
				)
			);
		}
		$configurator = $configuratorFactory($testCase);
		if ($configurator instanceof Configurator) {
			return $configurator;
		} else {
			throw new InvalidState(
				sprintf(
					'\'%1$s::getConfigurationFactory()\' should return instance of \'%1$s\'.',
					Configuration::class
				)
			);
		}
	}

}
