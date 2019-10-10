<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp;

use Nette\Configurator;

class Bootstrap
{

	public static function boot(): Configurator
	{
		$configurator = new Configurator();
		//$configurator->setDebugMode('23.75.345.200'); // enable for your remote IP
		$rootDir = __DIR__ . '/../../..';
		$configurator->enableTracy($rootDir . '/log');
		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory($rootDir . '/temp');
		$configurator->addConfig(__DIR__ . '/../config/common.neon');
		return $configurator;
	}

}
