<?php declare(strict_types = 1);

namespace Wavevision\NetteTests;

use Nette\Configurator;
use function is_callable;
use function sprintf;

class Configuration
{

	/**
	 * @var callable
	 */
	private static $configuratorFactory;

	public static function setup(callable $configuratorFactory): void
	{
		self::$configuratorFactory = $configuratorFactory;
	}

	public static function createConfigurator(): Configurator
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
		$configurator = $configuratorFactory();
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
