<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestCases;

use Wavevision\NetteTests\TestCases\Parts\FormAsserts;
use Wavevision\NetteTests\TestCases\Parts\PresenterAsserts;

abstract class PresenterTestCase extends DIContainerTestCase
{

	use PresenterAsserts;
	use FormAsserts;

}
