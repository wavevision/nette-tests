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

	public function testSubmitWithErrors(): void
	{
		$submitFormResponse = $this->submitForm(
			new SubmitFormRequest(
				'nestedForm',
				FormPresenter::class,
				'default',
				[],
				[
				]
			)
		);
		$this->assertSame(
			['c1' => ['c2' => ['name' => ['This field is required.']]]],
			$this->extractFormErrors($submitFormResponse)
		);
	}

	public function testFormErrors(): void
	{
		try {
			$this->assertValidForm(
				$this->submitForm(
					new SubmitFormRequest(
						'nestedForm',
						FormPresenter::class,
						'default',
						[],
						[
						]
					)
				)
			);
		} catch (ExpectationFailedException $ex) {
			if ($failure = $ex->getComparisonFailure()) {
				$this->assertStringContainsString(
					"Form 'nestedForm' should not contain errors, 1 error found",
					$ex->getMessage()
				);
				$this->assertSame(
					['c1' => ['c2' => ['name' => ['This field is required.']]]],
					$failure->getActual()
				);
				return;
			}
		}
		$this->fail('Form error was expected.');
	}

}
