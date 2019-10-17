<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use PHPUnit\Framework\Assert;
use Wavevision\NetteTests\Runners\InjectForms;
use Wavevision\NetteTests\Runners\SubmitFormRequest;
use Wavevision\NetteTests\Runners\SubmitFormResponse;

trait FormAsserts
{

	use InjectForms;

	protected function assertValidForm(SubmitFormResponse $submitFormResponse): void
	{
		$form = $submitFormResponse->getForm();
		$errors = $this->extractFormErrors($submitFormResponse);
		Assert::assertSame(
			[],
			$errors,
			sprintf("Form '%s' should not contain errors, %s error found.", $form->getName(), count($errors))
		);
		//todo get global errors
		Assert::assertTrue($form->isValid(), sprintf("Form '%s' is not valid.", $form->getName()));
	}

	/**
	 * @return array<mixed>
	 */
	protected function extractFormErrors(SubmitFormResponse $submitFormResponse): array
	{
		return $this->forms->formatFormErrors($submitFormResponse->getForm());
	}

	protected function submitForm(SubmitFormRequest $submitFormRequest): SubmitFormResponse
	{
		$this->forms->setup($submitFormRequest);
		return $this->forms->submit($submitFormRequest);
	}

}
