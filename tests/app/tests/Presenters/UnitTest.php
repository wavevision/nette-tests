<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

use PHPUnit\Framework\TestCase;
use Wavevision\NetteTests\Setup\AllowInjects;
use Wavevision\NetteTests\TestApp\Models\FunGenerator;
use Wavevision\NetteTests\TestApp\Models\InjectFunGenerator;

class UnitTest extends TestCase
{

	use InjectFunGenerator;

	public function testUseInjectInUnitTest(): void
	{
		$this->assertInstanceOf(FunGenerator::class, $this->funGenerator);
	}

	protected function setUp(): void
	{
		parent::setUp();
		$allowInjects = new AllowInjects();
		$allowInjects->fromCallback(
			$this,
			function (string $className) {
				return new $className();
			}
		);
	}

}
