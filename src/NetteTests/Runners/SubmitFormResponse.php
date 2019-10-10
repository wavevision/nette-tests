<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

use Nette\Application\UI\Form;
use Nette\SmartObject;

class SubmitFormResponse
{

	use SmartObject;

	/**
	 * @var SubmitFormRequest
	 */
	private $submitFormRequest;

	/**
	 * @var PresenterResponse
	 */
	private $presenterResponse;

	/**
	 * @var Form
	 */
	private $form;

	public function __construct(SubmitFormRequest $submitFormRequest, PresenterResponse $presenterResponse, Form $form)
	{
		$this->submitFormRequest = $submitFormRequest;
		$this->presenterResponse = $presenterResponse;
		$this->form = $form;
	}

	public function getSubmitFormRequest(): SubmitFormRequest
	{
		return $this->submitFormRequest;
	}

	public function getPresenterResponse(): PresenterResponse
	{
		return $this->presenterResponse;
	}

	public function getForm(): Form
	{
		return $this->form;
	}
}
