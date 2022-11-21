<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

use Nette\Application\Response;
use Nette\SmartObject;

class PresenterResponse
{

	use SmartObject;

	private PresenterRequest $presenterRequest;

	private Response $response;

	public function __construct(PresenterRequest $presenterRequest, Response $response)
	{
		$this->presenterRequest = $presenterRequest;
		$this->response = $response;
	}

	public function getPresenterRequest(): PresenterRequest
	{
		return $this->presenterRequest;
	}

	public function getResponse(): Response
	{
		return $this->response;
	}

}
