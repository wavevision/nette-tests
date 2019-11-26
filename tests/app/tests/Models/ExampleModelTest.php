<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Models;

use Nette\DI\Container;
use Nette\Http\IRequest;
use Wavevision\NetteTests\Mocks\RequestMock;
use Wavevision\NetteTests\TestApp\Models\InjectExampleModel;
use Wavevision\NetteTests\TestCases\DIContainerTestCase;

class ExampleModelTest extends DIContainerTestCase
{

	use InjectExampleModel;

	public function testGetDomain(): void
	{
		$this->assertSame('localhost', $this->exampleModel->getDomain());
	}

	public function testGetRemoteAddress(): void
	{
		$this->assertEquals(null, $this->exampleModel->getRemoteAddress());
		/** @var RequestMock $request */
		$request = $this->getContainer()->getByType(IRequest::class);
		$request->setRemoteAddressMock('104.16.107.144');
		$this->assertEquals('104.16.107.144', $this->exampleModel->getRemoteAddress());
	}

	public function testGetContainer(): void
	{
		$this->assertInstanceOf(Container::class, $this->getContainer());
	}

}
