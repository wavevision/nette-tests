<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Presenters;

use Nette\Application\UI\Presenter;
use Wavevision\NetteTests\TestApp\Models\BrokenSignal;

class ExamplePresenter extends Presenter
{

	public function actionJsonResponse(int $id): void
	{
		$this->sendJson(['id' => $id, 'post' => $this->getHttpRequest()->getPost()]);
	}

	public function actionRedirectResponse(): void
	{
		$this->redirectUrl('https://9gag.com');
	}

	public function handleBrokenSignal(): void
	{
		throw new BrokenSignal();
	}

	public function actionTerminate(): void
	{
		$this->terminate();
	}

}
