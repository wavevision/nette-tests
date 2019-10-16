<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

use Nette\Http\IRequest;
use Wavevision\NetteTests\InvalidState;
use Wavevision\NetteTests\Runners\PresenterRequest;
use Wavevision\NetteTests\TestApp\Models\BrokenSignal;
use Wavevision\NetteTests\TestApp\Presenters\ExamplePresenter;
use Wavevision\NetteTests\TestCases\PresenterTestCase;

class ExamplePresenterTest extends PresenterTestCase
{

	public function testTextResponse(): void
	{
		$text = $this->runPresenterAndReturnTextPayload(new PresenterRequest(ExamplePresenter::class, 'textResponse'));
		$this->assertEquals('Hello there!', $text);
	}

	public function testJsonResponse(): void
	{
		$payload = $this->runPresenterAndReturnJsonPayload(
			new PresenterRequest(
				ExamplePresenter::class,
				'jsonResponse',
				['id' => 1],
				IRequest::POST,
				['42']
			)
		);
		$this->assertEquals(
			[
				'id' => 1,
				'post' => ['42'],
			],
			$payload
		);
	}

	public function testRedirectResponse(): void
	{
		$url = $this->runPresenterAndReturnRedirectUrl(
			new PresenterRequest(ExamplePresenter::class, 'redirectResponse')
		);
		$this->assertEquals('https://9gag.com', $url);
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

}
