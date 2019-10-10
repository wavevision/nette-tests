<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases;

use Nette\Configurator;
use PHPUnit\Framework\TestCase;
use Wavevision\NetteTests\Configuration;
use Wavevision\NetteTests\InvalidState;
use Wavevision\NetteTests\TestCases\Parts\SetupContainer;

class DIContainerTestCase extends TestCase
{

	use SetupContainer;

	protected function setUp(): void
	{
		parent::setUp();
		$configuration = Configuration::getConfiguratorFactory()($this);
		if ($configuration instanceof Configurator) {
			$this->setupContainer($configuration, $this);
		} else {
			throw new InvalidState(
				sprintf(
					"'%s::getConfigurationFactory()' should return instance of '%s'.",
					Configuration::class,
					Configurator::class
				)
			);
		}
	}

}
