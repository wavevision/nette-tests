<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Presenters;

use Nette\Application\UI\Presenter;
use Wavevision\NetteTests\TestApp\Models\BrokenSignal;

class ExamplePresenter extends Presenter
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

}
