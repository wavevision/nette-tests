<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

use Wavevision\NetteTests\Runners\PresenterRequest;
use Wavevision\NetteTests\Runners\SubmitFormRequest;
use Wavevision\NetteTests\TestApp\Presenters\BrokenSignal;
use Wavevision\NetteTests\TestApp\Presenters\HomepagePresenter;
use Wavevision\NetteTests\TestCases\PresenterTestCase;

class HomepagePresenterTest extends PresenterTestCase
{

	public function testTextResponse(): void
	{
		$text = $this->assertTextResponse(new PresenterRequest(HomepagePresenter::class, 'textResponse'));
		$this->assertEquals('Hello there!', $text);
	}

	public function testJsonResponse(): void
	{
		$payload = $this->assertJsonResponse(new PresenterRequest(HomepagePresenter::class, 'jsonResponse'));
		$this->assertEquals(['42'], $payload);
	}

	public function testRedirectResponse(): void
	{
		$url = $this->assertRedirectResponse(new PresenterRequest(HomepagePresenter::class, 'redirectResponse'));
		$this->assertEquals('https://9gag.com', $url);
	}

	public function testSignal(): void
	{
		$presenterRequest = (new PresenterRequest(HomepagePresenter::class))->setSignal('brokenSignal');
		$this->expectException(BrokenSignal::class);
		$this->setupAndRunPresenter($presenterRequest);
	}

	public function testSubmitForm(): void
	{
		$this->assertValidForm(
			new SubmitFormRequest(
				'form',
				HomepagePresenter::class,
				'default',
				[],
				[
					'name' => 'Biggus Dickus',
				]
			)
		);
	}

}
