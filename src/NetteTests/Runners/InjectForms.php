<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

trait InjectForms
{

	protected Forms $forms;

	public function injectForms(Forms $forms): void
	{
		$this->forms = $forms;
	}

}
