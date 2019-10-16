<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use Nette\Application\Responses\FileResponse;
use Nette\Application\Responses\ForwardResponse;
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
	protected function runPresenterAndExpectTextContent(PresenterRequest $presenterRequest): string
	{
		return (string)$this->runPresenterAndExpectResponseType(TextResponse::class, $presenterRequest)
			->getSource();
	}

	/**
	 * @return array<mixed> - json payload
	 */
	protected function runPresenterAndExpectJsonPayload(PresenterRequest $presenterRequest): array
	{
		return $this->runPresenterAndExpectResponseType(JsonResponse::class, $presenterRequest)->getPayload();
	}

	/**
	 * @return string - redirect url
	 */
	protected function runPresenterAndExpectRedirectUrl(PresenterRequest $presenterRequest): string
	{
		return $this->runPresenterAndExpectResponseType(RedirectResponse::class, $presenterRequest)->getUrl();
	}

	/**
	 * @return IResponse|TextResponse|JsonResponse|RedirectResponse|FileResponse|ForwardResponse
	 */
	protected function runPresenterAndExpectResponseType(
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
