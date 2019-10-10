<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

use Nette\Application\IPresenterFactory;
use Nette\Application\PresenterFactory;
use Nette\Application\Request;
use Nette\Application\UI\Presenter;
use Wavevision\NetteTests\InvalidState;
use Wavevision\NetteTests\Mocks\RequestMock;

class Presenters
{

	/**
	 * @var PresenterFactory
	 */
	private $presenterFactory;

	public function __construct(IPresenterFactory $presenterFactory)
	{
		if ($presenterFactory instanceof PresenterFactory) {
			$this->presenterFactory = $presenterFactory;
		} else {
			throw new InvalidState('PresenterFactory expected.');
		}
	}

	public function setup(PresenterRequest $presenterRequest): PresenterRequest
	{
		$presenterClassName = $presenterRequest->getClassName();
		$presenterName = $this->presenterFactory->unformatPresenterClass($presenterClassName);
		if ($presenterName === null) {
			throw new InvalidState(sprintf("Presenter not found for class '%s'.", $presenterClassName));
		}
		$presenter = $this->createPresenter($presenterName);
		$presenter->autoCanonicalize = false;
		$presenterRequest->setPresenter($presenter);
		$presenterRequest->setPresenterName($presenterName);
		$this->setupHttpRequest($presenterRequest);
		return $presenterRequest;
	}

	public function run(PresenterRequest $presenterRequest): PresenterResponse
	{
		$presenter = $presenterRequest->getPresenter();
		$response = $presenter->run(
			new Request(
				$presenterRequest->getPresenterName(),
				$presenterRequest->getMethod(),
				$presenterRequest->getQuery(),
				$presenterRequest->getPost(),
				$presenterRequest->getFiles()
			)
		);
		return new PresenterResponse($presenterRequest, $response);
	}

	private function createPresenter(string $name): Presenter
	{
		$presenter = $this->presenterFactory->createPresenter($name);
		if ($presenter instanceof Presenter) {
			return $presenter;
		}
	}

	private function setupHttpRequest(PresenterRequest $presenterRequest): void
	{
		$httpRequest = $presenterRequest->getPresenter()->getHttpRequest();
		if ($httpRequest instanceof RequestMock) {
			$httpRequest->setPostMock($presenterRequest->getPost());
			$httpRequest->setMethodMock($presenterRequest->getMethod());
			$httpRequest->setFilesMock($presenterRequest->getFiles());
		} else {
			throw new InvalidState('HttpRequest should be mocked.');
		}
	}
}
