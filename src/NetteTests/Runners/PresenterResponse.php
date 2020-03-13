<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

use Nette\Application\IResponse;
use Nette\SmartObject;

class PresenterResponse
{

	use SmartObject;

	private PresenterRequest $presenterRequest;

	private IResponse $response;

	public function __construct(PresenterRequest $presenterRequest, IResponse $response)
	{
		$this->presenterRequest = $presenterRequest;
		$this->response = $response;
	}

	public function getPresenterRequest(): PresenterRequest
	{
		return $this->presenterRequest;
	}

	public function getResponse(): IResponse
	{
		return $this->response;
	}

}
