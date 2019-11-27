<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Models;

trait InjectFunGenerator
{

	/**
	 * @var FunGenerator
	 */
	protected $funGenerator;

	public function injectFunGenerator(FunGenerator $funGenerator): void
	{
		$this->funGenerator = $funGenerator;
	}

}
