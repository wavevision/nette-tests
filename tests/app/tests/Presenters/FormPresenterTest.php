<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Presenters;

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

}
