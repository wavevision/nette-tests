<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Models;

use Nette\DI\Container;
use Wavevision\NetteTests\TestApp\Models\InjectExampleModel;
use Wavevision\NetteTests\TestCases\DIContainerTestCase;

class ExampleModelTest extends DIContainerTestCase
{

	use InjectExampleModel;

	public function testGetDomain(): void
	{
		$this->assertSame('localhost', $this->exampleModel->getDomain());
	}

	public function testGetContainer(): void
	{
		$this->assertInstanceOf(Container::class, $this->getContainer());
	}

}
