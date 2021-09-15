<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

use Nette\Application\Responses\JsonResponse;
use Wavevision\NetteTests\InvalidState;
use Wavevision\NetteTests\Runners\PresenterRequest;
use Wavevision\NetteTests\TestApp\Presenters\ErrorPresenter;
use Wavevision\NetteTests\TestCases\PresenterTestCase;

class ErrorPresenterTest extends PresenterTestCase
{

	public function testRun(): void
	{
		$presenterResponse = $this->runPresenter(new PresenterRequest(ErrorPresenter::class));
		$this->assertInstanceOf(JsonResponse::class, $presenterResponse->getResponse());
	}

	public function testExtractFlashMessages(): void
	{
		$this->expectException(InvalidState::class);
		$presenterResponse = $this->runPresenter(new PresenterRequest(ErrorPresenter::class));
		$this->extractFlashMessages($presenterResponse);
	}

}
