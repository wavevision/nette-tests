<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases;

use PHPUnit\Framework\TestCase;
use Wavevision\NetteTests\Configuration;
use Wavevision\NetteTests\TestCases\Parts\SetupContainer;

abstract class DIContainerTestCase extends TestCase
{

	use SetupContainer;

	protected function setUp(): void
	{
		parent::setUp();
		$this->setupContainer(Configuration::createConfigurator(), $this);
	}

}
