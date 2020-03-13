<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

use Nette\Application\UI\Form;
use Nette\SmartObject;

class SubmitFormResponse
{

	use SmartObject;

	private SubmitFormRequest $submitFormRequest;

	private PresenterResponse $presenterResponse;

	private Form $form;

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
