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
			new SubmitFormRequest(
				'form',
				FormPresenter::class,
				'default',
				[],
				[
					'name' => 'Biggus Dickus',
				]
			)
		);
	}

	public function testFormErrors(): void
	{
		try {
			$this->assertValidForm(
				new SubmitFormRequest(
					'nestedForm',
					FormPresenter::class,
					'default',
					[],
					[
					]
				)
			);
		} catch (ExpectationFailedException $ex) {
			$this->assertSame(
				['c1' => ['c2' => ['name' => ['This field is required.']]]],
				$ex->getComparisonFailure()->getActual()
			);
		}
	}

}
