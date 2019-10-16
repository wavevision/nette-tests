<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use Nette\Application\Responses\JsonResponse;
use Nette\Application\Responses\RedirectResponse;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;
use PHPUnit\Framework\Assert;
use Wavevision\NetteTests\Runners\InjectPresenters;
use Wavevision\NetteTests\Runners\PresenterRequest;
use Wavevision\NetteTests\Runners\PresenterResponse;

trait PresenterAsserts
{

	use InjectPresenters;

	/**
	 * @return string - renderer text output
	 */
	protected function runPresenterAndReturnTextPayload(PresenterRequest $presenterRequest): string
	{
		/** @var TextResponse $textResponse */
		$textResponse = $this->runPresenterAndReturnResponse(TextResponse::class, $presenterRequest);
		return (string)$textResponse->getSource();
	}

	/**
	 * @return array<mixed> - json payload
	 */
	protected function runPresenterAndReturnJsonPayload(PresenterRequest $presenterRequest): array
	{
		/** @var JsonResponse $jsonResponse */
		$jsonResponse = $this->runPresenterAndReturnResponse(JsonResponse::class, $presenterRequest);
		return $jsonResponse->getPayload();
	}

	/**
	 * @return string - redirect url
	 */
	protected function runPresenterAndReturnRedirectUrl(PresenterRequest $presenterRequest): string
	{
		/** @var RedirectResponse $redirectResponse */
		$redirectResponse = $this->runPresenterAndReturnResponse(RedirectResponse::class, $presenterRequest);
		return $redirectResponse->getUrl();
	}

	/**
	 * @return IResponse|mixed - todo fix phpstan early exit
	 */
	protected function runPresenterAndReturnResponse(
		string $expectedResponseType,
		PresenterRequest $presenterRequest
	) {
		$presenterResponse = $this->runPresenter($presenterRequest);
		$this->assertResponseType($expectedResponseType, $presenterResponse);
		return $presenterResponse->getResponse();
	}

	protected function assertResponseExists(PresenterResponse $presenterResponse): void
	{
		Assert::assertNotNull($presenterResponse->getResponse(), 'Some response is expected.');
	}

	protected function assertResponseType(string $expectedResponseType, PresenterResponse $presenterResponse): void
	{
		$this->assertResponseExists($presenterResponse);
		Assert::assertInstanceOf($expectedResponseType, $presenterResponse->getResponse(), 'Invalid response type.');
	}

	protected function runPresenter(PresenterRequest $presenterRequest): PresenterResponse
	{
		$this->presenters->setup($presenterRequest);
		return $this->presenters->run($presenterRequest);
	}

}
