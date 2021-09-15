<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Presenters;

use Nette\Application\IPresenter;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\JsonResponse;

class ErrorPresenter implements IPresenter
{

	public function run(Request $request): Response
	{
		return new JsonResponse([]);
	}

}
