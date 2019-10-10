# Wavevision NetteTests

[![Build Status](https://travis-ci.org/wavevision/nette-tests.svg?branch=master)](https://travis-ci.org/wavevision/nette-tests)
[![Coverage Status](https://coveralls.io/repos/github/wavevision/nette-tests/badge.svg?branch=master)](https://coveralls.io/github/wavevision/nette-tests?branch=master)
[![PHPStan](https://img.shields.io/badge/style-level%20max-brightgreen.svg?label=phpstan)](https://github.com/phpstan/phpstan)

[phpunit](https://github.com/sebastianbergmann/phpunit/) extension for testing nette applications

## Features

* [DI container](tests/app/tests/Models/ExampleModelTest.php) in tests, allow services [injects](tests/app/tests/Models/ExampleModelTest.php) in tests 
* [presenter](tests/app/tests/Presenters/ExamplePresenterTest.php) testing
* [form](tests/app/tests/Presenters/FormPresenterTest.php) submit testing


## Install

```
composer require --dev wavevision/nette-tests
```

## Configuration

Add callback for creating `Nette\Configurator` to [bootstrap](tests/app/tests/bootstrap.php) for tests.
