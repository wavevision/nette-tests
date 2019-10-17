<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Presenters;

use Nette\Application\Responses\FileResponse;
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

	public function actionTerminateResponse(): void
	{
		$this->terminate();
	}

	public function actionFileResponse(): void
	{
		$this->sendResponse(new FileResponse(__DIR__ . '/file.txt'));
	}

	public function actionForwardResponse(): void
	{
		$this->forward('default');
	}

}
