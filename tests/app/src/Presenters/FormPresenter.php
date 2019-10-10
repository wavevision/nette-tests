<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Presenters;

use Nette\Application\UI\Form;

class FormPresenter extends BasePresenter
{

	protected function createComponentForm(): Form
	{
		$form = new Form();
		$form->addText('name');
		$form->addSubmit('submit');
		return $form;
	}

}
