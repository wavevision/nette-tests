<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

trait InjectForms
{

	/**
	 * @var Forms
	 */
	private $forms;

	public function injectForms(Forms $forms): void
	{
		$this->forms = $forms;
	}
}
