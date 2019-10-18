<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

use PHPUnit\Framework\ExpectationFailedException;
use Wavevision\NetteTests\Runners\SubmitFormRequest;
use Wavevision\NetteTests\TestApp\Presenters\FormPresenter;
use Wavevision\NetteTests\TestCases\PresenterTestCase;

class FormPresenterTest extends PresenterTestCase
{

	public function testSubmitForm(): void
	{
		$this->assertValidForm(
			$this->submitForm(
				new SubmitFormRequest(
					'form',
					FormPresenter::class,
					'default',
					[],
					[
						'name1' => 'Biggus Dickus',
					]
				)
			)
		);
	}

	public function testFormInputErrors(): void
	{
		$this->checkFormErrors(
			'nestedForm',
			"Form 'nestedForm' is not valid - 1 errors found.",
			[
				'formErrors' => ['This field is required.'],
				'inputErrors' => ['c1' => ['c2' => ['name' => ['This field is required.']]]],
			]
		);
	}

	public function testFormErrors(): void
	{
		$this->checkFormErrors(
			'formError',
			"Form 'formError' is not valid - 1 errors found.",
			[
				'formErrors' => ['customError'],
				'inputErrors' => [],
			]
		);
	}

	/**
	 * @param array<mixed> $expectedErrors
	 */
	public function checkFormErrors(string $formName, string $expectedMessage, array $expectedErrors): void
	{
		try {
			$this->assertValidForm(
				$this->submitForm(
					new SubmitFormRequest(
						$formName,
						FormPresenter::class,
						'default',
						[],
						[]
					)
				)
			);
		} catch (ExpectationFailedException $ex) {
			if ($failure = $ex->getComparisonFailure()) {
				$this->assertStringContainsString(
					$expectedMessage,
					$ex->getMessage()
				);
				$this->assertSame(
					$expectedErrors,
					$failure->getActual()
				);
				return;
			}
		}
		$this->fail('Form error was expected.');
	}

}
