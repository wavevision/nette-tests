<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Models;

trait InjectFunGenerator
{

	protected FunGenerator $funGenerator;

	public function injectFunGenerator(FunGenerator $funGenerator): void
	{
		$this->funGenerator = $funGenerator;
	}

}
