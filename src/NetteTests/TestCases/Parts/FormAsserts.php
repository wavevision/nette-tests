<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;
use Wavevision\NetteTests\Runners\InjectForms;
use Wavevision\NetteTests\Runners\SubmitFormRequest;
use Wavevision\NetteTests\Runners\SubmitFormResponse;
use function count;
use function print_r;
use function sprintf;

trait FormAsserts
{

	use InjectForms;

	protected function assertValidForm(SubmitFormResponse $submitFormResponse): void
	{
		$form = $submitFormResponse->getForm();
		$inputErrors = $this->forms->formatFormErrors($form);
		$globalErrors = $form->getErrors();
		if (!$form->isValid()) {
			$errors = [
				'formErrors' => $globalErrors,
				'inputErrors' => $inputErrors,
			];
			throw new ExpectationFailedException(
				sprintf(
					"Form '%s' is not valid - %s errors found.",
					$submitFormResponse->getSubmitFormRequest()->getFormName(),
					count($globalErrors)
				),
				new ComparisonFailure(
					'no errors',
					$errors,
					'no errors',
					print_r($errors, true)
				)
			);
		}
		Assert::assertTrue($form->isValid());
	}

	protected function submitForm(SubmitFormRequest $submitFormRequest): SubmitFormResponse
	{
		$this->forms->setup($submitFormRequest);
		return $this->forms->submit($submitFormRequest);
	}

}
