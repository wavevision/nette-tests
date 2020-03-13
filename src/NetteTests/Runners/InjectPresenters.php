<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

trait InjectPresenters
{

	protected Presenters $presenters;

	public function injectPresenters(Presenters $presenters): void
	{
		$this->presenters = $presenters;
	}

}
