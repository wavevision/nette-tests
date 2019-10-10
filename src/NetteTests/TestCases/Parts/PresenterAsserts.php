<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use Nette\Application\IResponse;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\Responses\RedirectResponse;
use Nette\Application\Responses\TextResponse;
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
	protected function assertTextResponse(PresenterRequest $presenterRequest): string
	{
		/** @var TextResponse $response */
		$response = $this->assertResponseType(TextResponse::class, $presenterRequest);
		return (string)$response->getSource();
	}

	/**
	 * @return array<mixed> - json payload
	 */
	protected function assertJsonResponse(PresenterRequest $presenterRequest): array
	{
		/** @var JsonResponse $response */
		$response = $this->assertResponseType(JsonResponse::class, $presenterRequest);
		return $response->getPayload();
	}

	/**
	 * @return string - redirect url
	 */
	protected function assertRedirectResponse(PresenterRequest $presenterRequest): string
	{
		/** @var RedirectResponse $response */
		$response = $this->assertResponseType(RedirectResponse::class, $presenterRequest);
		return $response->getUrl();
	}

	protected function assertHasResponse(PresenterRequest $presenterRequest): IResponse
	{
		$presenterResponse = $this->setupAndRunPresenter($presenterRequest);
		$response = $presenterResponse->getResponse();
		Assert::assertNotNull($response);
		return $response;
	}

	protected function assertResponseType(string $responseType, PresenterRequest $presenterRequest): IResponse
	{
		$response = $this->assertHasResponse($presenterRequest);
		Assert::assertInstanceOf($responseType, $response);
		return $response;
	}

	protected function setupAndRunPresenter(PresenterRequest $presenterRequest): PresenterResponse
	{
		$this->presenters->setup($presenterRequest);
		return $this->presenters->run($presenterRequest);
	}

}
