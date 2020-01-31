<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

use Nette\Application\Responses\VoidResponse;
use Nette\Http\IRequest;
use PHPUnit\Framework\AssertionFailedError;
use Wavevision\NetteTests\InvalidState;
use Wavevision\NetteTests\Runners\PresenterRequest;
use Wavevision\NetteTests\Runners\PresenterResponse;
use Wavevision\NetteTests\TestApp\Models\BrokenSignal;
use Wavevision\NetteTests\TestApp\Presenters\ExamplePresenter;
use Wavevision\NetteTests\TestCases\PresenterTestCase;

class ExamplePresenterTest extends PresenterTestCase
{

	public function testFlashMessage(): void
	{
		$this->assertSame(
			[
				[
					'message' => 'Hello there!',
					'type' => 'warning',
				],
			],
			$this->extractFlashMessages(
				$this->runPresenter(new PresenterRequest(ExamplePresenter::class, 'flash'))
			)
		);
	}

	public function testAjaxRequest(): void
	{
		$this->assertInstanceOf(
			VoidResponse::class,
			$this->runPresenter(new PresenterRequest(ExamplePresenter::class, 'ajax'))->getResponse()
		);
		$this->assertTrue(
			$this->extractJsonResponsePayload(
				$this->runPresenter((new PresenterRequest(ExamplePresenter::class, 'ajax'))->setAjax(true))
			)
		);
	}

	public function testTextResponse(): void
	{
		$this->assertStringContainsString(
			'Hello there!',
			$this->extractTextResponseContent(
				$this->runPresenter(new PresenterRequest(ExamplePresenter::class, 'textResponse'))
			)
		);
	}

	public function testJsonResponse(): void
	{
		$this->assertEquals(
			[
				'id' => 1,
				'post' => ['42'],
			],
			$this->extractJsonResponsePayload(
				$this->runPresenter(
					new PresenterRequest(
						ExamplePresenter::class,
						'jsonResponse',
						['id' => 1],
						IRequest::POST,
						['42']
					)
				)
			)
		);
	}

	public function testRedirectResponse(): void
	{
		$this->assertEquals(
			'https://9gag.com',
			$this->extractRedirectResponseUrl(
				$this->runPresenter(new PresenterRequest(ExamplePresenter::class, 'redirectResponse'))
			)
		);
	}

	public function testFileResponse(): void
	{
		$this->assertStringContainsString(
			'Presenters/file.txt',
			$this->extractFileResponseFile(
				$this->runPresenter(new PresenterRequest(ExamplePresenter::class, 'fileResponse'))
			)
		);
	}

	public function testForwardResponse(): void
	{
		$request = $this->extractForwardResponseRequest(
			$this->runPresenter(new PresenterRequest(ExamplePresenter::class, 'forwardResponse'))
		);
		$this->assertEquals('Example', $request->getPresenterName());
	}

	public function testSignal(): void
	{
		$presenterRequest = (new PresenterRequest(ExamplePresenter::class))->setSignal('brokenSignal');
		$this->expectException(BrokenSignal::class);
		$this->runPresenter($presenterRequest);
	}

	public function testNonExistingPresenter(): void
	{
		$this->expectException(InvalidState::class);
		$this->expectExceptionMessage("Presenter not found for class 'NotPresenter'.");
		$this->runPresenter((new PresenterRequest('NotPresenter')));
	}

	public function testBeforeRunCallback(): void
	{
		$called = false;
		$presenterRequest = (new PresenterRequest(ExamplePresenter::class))->addBeforeRunCallback(
			function (PresenterRequest $presenterRequest) use (&$called): void {
				$called = true;
				$this->assertInstanceOf(ExamplePresenter::class, $presenterRequest->getPresenter());
				$this->assertEquals('Example', $presenterRequest->getPresenterName());
			}
		);
		$this->runPresenter($presenterRequest);
		$this->assertTrue($called);
	}

	public function testNotTextResponse(): void
	{
		$presenterResponse = $this->getTerminatePresenterResponse();
		$this->expectExceptionMessage("Invalid response type 'Nette\Application\Responses\TextResponse' was expected.");
		$this->extractTextResponse($presenterResponse);
	}

	public function testNotJsonResponse(): void
	{
		$presenterResponse = $this->getTerminatePresenterResponse();
		$this->expectExceptionMessage("Invalid response type 'Nette\Application\Responses\JsonResponse' was expected.");
		$this->extractJsonResponse($presenterResponse);
	}

	public function testNotRedirectResponse(): void
	{
		$presenterResponse = $this->getTerminatePresenterResponse();
		$this->expectExceptionMessage(
			"Invalid response type 'Nette\Application\Responses\RedirectResponse' was expected."
		);
		$this->extractRedirectResponse($presenterResponse);
	}

	public function testNotFileResponse(): void
	{
		$presenterResponse = $this->getTerminatePresenterResponse();
		$this->expectExceptionMessage(
			"Invalid response type 'Nette\Application\Responses\FileResponse' was expected."
		);
		$this->extractFileResponse($presenterResponse);
	}

	public function testNotForwardResponse(): void
	{
		$presenterResponse = $this->getTerminatePresenterResponse();
		$this->expectExceptionMessage(
			"Invalid response type 'Nette\Application\Responses\ForwardResponse' was expected."
		);
		$this->extractForwardResponse($presenterResponse);
	}

	public function testQueryMock(): void
	{
		$presenterRequest = new PresenterRequest(ExamplePresenter::class, 'queryMock', ['q' => '42']);
		$presenterResponse = $this->runPresenter($presenterRequest);
		$this->assertInstanceOf(VoidResponse::class, $presenterResponse->getResponse());
	}

	private function getTerminatePresenterResponse(): PresenterResponse
	{
		$presenterRequest = new PresenterRequest(ExamplePresenter::class, 'terminateResponse');
		$presenterResponse = $this->runPresenter($presenterRequest);
		$this->expectException(AssertionFailedError::class);
		return $presenterResponse;
	}

}
