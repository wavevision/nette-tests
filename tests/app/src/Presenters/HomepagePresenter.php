<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Presenters;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;

class HomepagePresenter extends Presenter
{

	public function actionJsonResponse(): void
	{
		$this->sendJson(['42']);
	}

	public function actionRedirectResponse(): void
	{
		$this->redirectUrl('https://9gag.com');
	}

	public function handleBrokenSignal(): void
	{
		throw new BrokenSignal();
	}

	protected function createComponentForm(): Form
	{
		$form = new Form();
		$form->addText('name');
		$form->addSubmit('submit');
		return $form;
	}

}
