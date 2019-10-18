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

	protected function createComponentNestedForm(): Form
	{
		$form = new Form();
		$c1 = $form->addContainer('c1');
		$c2 = $c1->addContainer('c2');
		$c2->addText('name')
			->setRequired();
		return $form;
	}

	protected function createComponentFormError(): Form
	{
		$form = new Form();
		$form->addError('customError');
		return $form;
	}

}
