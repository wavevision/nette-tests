<?php declare(strict_types = 1);

namespace Wavevision\NetteTests;

class Configuration
{

	/**
	 * @var callable
	 */
	private static $configuratorFactory;

	public static function setConfiguratorFactory(callable $configuratorFactory): void
	{
		self::$configuratorFactory = $configuratorFactory;
	}

	public static function getConfiguratorFactory(): callable
	{
		return self::$configuratorFactory;
	}

}
