# Wavevision NetteTests

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