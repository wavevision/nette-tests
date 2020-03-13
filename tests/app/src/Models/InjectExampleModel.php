<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Models;

trait InjectExampleModel
{

	private ExampleModel $exampleModel;

	public function injectExampleModel(ExampleModel $exampleModel): void
	{
		$this->exampleModel = $exampleModel;
	}

}
