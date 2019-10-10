<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases\Parts;

use PHPUnit\Framework\Assert;
use Wavevision\NetteTests\Runners\InjectForms;
use Wavevision\NetteTests\Runners\SubmitFormRequest;
use Wavevision\NetteTests\Runners\SubmitFormResponse;

trait FormAsserts
{

	use InjectForms;

	protected function assertValidForm(SubmitFormRequest $submitFormRequest): void
	{
		$submitFormResponse = $this->setupAndSubmitForm($submitFormRequest);
		$form = $submitFormResponse->getForm();
		if (!$form->isValid()) {
			$errors = $this->forms->formatFormErrors($form);
			Assert::assertSame([], $errors);
		}
		Assert::assertTrue($form->isValid());
	}

	protected function setupAndSubmitForm(SubmitFormRequest $submitFormRequest): SubmitFormResponse
	{
		$this->forms->setup($submitFormRequest);
		return $this->forms->submit($submitFormRequest);
	}
}
