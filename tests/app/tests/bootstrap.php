<?php declare(strict_types = 1);

use Nette\Configurator;
use Wavevision\NetteTests\Configuration;

require __DIR__ . '/../../../vendor/autoload.php';
Configuration::setConfiguratorFactory(
	function (): Configurator {
		$configurator = new Configurator();
		$rootDir = __DIR__ . '/..';
		$configurator->addConfig($rootDir . '/config/common.neon');
		$tempDir = $rootDir . '/../../temp';
		$configurator->setTempDirectory($tempDir);
		$configurator->addParameters(['wwwDir' => $tempDir]);
		return $configurator;
	}
);
