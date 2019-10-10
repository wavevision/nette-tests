<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Models;

trait InjectExampleModel
{

	/**
	 * @var ExampleModel
	 */
	private $exampleModel;

	public function injectExampleModel(ExampleModel $exampleModel): void
	{
		$this->exampleModel = $exampleModel;
	}

}
