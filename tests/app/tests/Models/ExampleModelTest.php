<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Models;

use Wavevision\NetteTests\TestApp\Models\ExampleModel;
use Wavevision\NetteTests\TestCases\DIContainerTestCase;

class ExampleModelTest extends DIContainerTestCase
{

	public function testGetDomain(): void
	{
		$exampleModel = $this->getContainer()->getByType(ExampleModel::class);
		$this->assertSame('localhost', $exampleModel->getDomain());
	}

}
