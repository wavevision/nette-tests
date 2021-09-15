<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Setup;

use Nette\DI\Container;
use Nette\SmartObject;
use Nette\Utils\Strings;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use Wavevision\DIServiceAnnotation\DIService;
use function array_filter;

/**
 * @DIService
 */
class AllowInjects
{

	use SmartObject;

	public function process(Container $container, TestCase $testCase): void
	{
		$this->fromCallback(
			$testCase,
			[$container, 'getByType']
		);
	}

	public function fromCallback(object $testCase, callable $getService): void
	{
		// dont judge me
		$ref = new ReflectionClass($testCase);
		$injectMethods = array_filter(
			$ref->getMethods(ReflectionMethod::IS_PUBLIC),
			function (ReflectionMethod $method) {
				return Strings::startsWith($method->getName(), 'inject');
			}
		);
		/** @var ReflectionMethod $method */
		foreach ($injectMethods as $method) {
			/** @var ReflectionNamedType|null $parameterType */
			$parameterType = $method->getParameters()[0]->getType();
			if ($parameterType === null) {
				continue;
			}
			$testCase->{$method->getName()}($getService($parameterType->getName()));
		}
	}

}
