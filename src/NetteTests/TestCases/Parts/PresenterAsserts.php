<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use Nette\Application\Request;
use Nette\Application\Responses\FileResponse;
use Nette\Application\Responses\ForwardResponse;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\Responses\RedirectResponse;
use Nette\Application\Responses\TextResponse;
use PHPUnit\Framework\Assert;
use Wavevision\NetteTests\Runners\InjectPresenters;
use Wavevision\NetteTests\Runners\PresenterRequest;
use Wavevision\NetteTests\Runners\PresenterResponse;
use function sprintf;

trait PresenterAsserts
{

	use InjectPresenters;

	protected function extractTextResponse(PresenterResponse $presenterResponse): TextResponse
	{
		$response = $presenterResponse->getResponse();
		if ($response instanceof TextResponse) {
			return $response;
		}
		$this->failWithInvalidResponseType(TextResponse::class);
	}

	protected function extractJsonResponse(PresenterResponse $presenterResponse): JsonResponse
	{
		$response = $presenterResponse->getResponse();
		if ($response instanceof JsonResponse) {
			return $response;
		}
		$this->failWithInvalidResponseType(JsonResponse::class);
	}

	protected function extractRedirectResponse(PresenterResponse $presenterResponse): RedirectResponse
	{
		$response = $presenterResponse->getResponse();
		if ($response instanceof RedirectResponse) {
			return $response;
		}
		$this->failWithInvalidResponseType(RedirectResponse::class);
	}

	protected function extractFileResponse(PresenterResponse $presenterResponse): FileResponse
	{
		$response = $presenterResponse->getResponse();
		if ($response instanceof FileResponse) {
			return $response;
		}
		$this->failWithInvalidResponseType(FileResponse::class);
	}

	protected function extractForwardResponse(PresenterResponse $presenterResponse): ForwardResponse
	{
		$response = $presenterResponse->getResponse();
		if ($response instanceof ForwardResponse) {
			$response->getRequest();
			return $response;
		}
		$this->failWithInvalidResponseType(ForwardResponse::class);
	}

	protected function extractTextResponseContent(PresenterResponse $presenterResponse): string
	{
		return (string)$this->extractTextResponse($presenterResponse)->getSource();
	}

	/**
	 * @return mixed
	 */
	protected function extractJsonResponsePayload(PresenterResponse $presenterResponse)
	{
		return $this->extractJsonResponse($presenterResponse)->getPayload();
	}

	protected function extractRedirectResponseUrl(PresenterResponse $presenterResponse): string
	{
		return $this->extractRedirectResponse($presenterResponse)->getUrl();
	}

	protected function extractFileResponseFile(PresenterResponse $presenterResponse): string
	{
		return $this->extractFileResponse($presenterResponse)->getFile();
	}

	protected function extractForwardResponseRequest(PresenterResponse $presenterResponse): Request
	{
		return $this->extractForwardResponse($presenterResponse)->getRequest();
	}

	/**
	 * @return array<mixed>
	 */
	protected function extractFlashMessages(PresenterResponse $presenterResponse, bool $toArray = true): array
	{
		$flashes = [];
		foreach ($presenterResponse->getPresenterRequest()->getPresenter()->getTemplate()->flashes as $flash) {
			$flashes[] = $toArray ? (array)$flash : $flash;
		}
		return $flashes;
	}

	protected function runPresenter(PresenterRequest $presenterRequest): PresenterResponse
	{
		$this->presenters->setup($presenterRequest);
		return $this->presenters->run($presenterRequest);
	}

	private function failWithInvalidResponseType(string $expected): void
	{
		Assert::fail(sprintf("Invalid response type '%s' was expected.", $expected));
	}

}
