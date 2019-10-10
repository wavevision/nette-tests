<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

trait InjectPresenters
{

	/**
	 * @var Presenters
	 */
	private $presenters;

	public function injectPresenters(Presenters $presenters): void
	{
		$this->presenters = $presenters;
	}
}
