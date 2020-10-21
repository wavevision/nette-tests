<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use Nette\Configurator;
use Nette\DI\Container;
use PHPUnit\Framework\TestCase;
use Wavevision\NetteTests\Setup\ConfigureContainer;

trait SetupContainer
{

	private Container $container;

	protected function setupContainer(Configurator $configurator, TestCase $testCase): void
	{
		$this->container = (new ConfigureContainer())->process($configurator, $testCase);
	}

	protected function getContainer(): Container
	{
		return $this->container;
	}

}
