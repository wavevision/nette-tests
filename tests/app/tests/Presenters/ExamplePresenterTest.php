<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

use Wavevision\NetteTests\InvalidState;
use Wavevision\NetteTests\Runners\PresenterRequest;
use Wavevision\NetteTests\TestApp\Models\BrokenSignal;
use Wavevision\NetteTests\TestApp\Presenters\ExamplePresenter;
use Wavevision\NetteTests\TestCases\PresenterTestCase;

class ExamplePresenterTest extends PresenterTestCase
{

	public function testTextResponse(): void
	{
		$text = $this->assertTextResponse(new PresenterRequest(ExamplePresenter::class, 'textResponse'));
		$this->assertEquals('Hello there!', $text);
	}

	public function testJsonResponse(): void
	{
		$payload = $this->assertJsonResponse(new PresenterRequest(ExamplePresenter::class, 'jsonResponse'));
		$this->assertEquals(['42'], $payload);
	}

	public function testRedirectResponse(): void
	{
		$url = $this->assertRedirectResponse(new PresenterRequest(ExamplePresenter::class, 'redirectResponse'));
		$this->assertEquals('https://9gag.com', $url);
	}

	public function testSignal(): void
	{
		$presenterRequest = (new PresenterRequest(ExamplePresenter::class))->setSignal('brokenSignal');
		$this->expectException(BrokenSignal::class);
		$this->setupAndRunPresenter($presenterRequest);
	}

	public function testNonExistingPresenter(): void
	{
		$this->expectException(InvalidState::class);
		$this->expectExceptionMessage("Presenter not found for class 'NotPresenter'.");
		$this->setupAndRunPresenter((new PresenterRequest('NotPresenter')));
	}

}
