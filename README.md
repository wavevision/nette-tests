<p align="center"><a href="https://github.com/wavevision"><img alt="Wavevision s.r.o." src="https://wavevision.com/images/wavevision-logo.png" width="120" /></a></p>
<h1 align="center">Nette Tests</h1>

[![CI](https://github.com/wavevision/nette-tests/workflows/CI/badge.svg)](https://github.com/wavevision/nette-tests/actions/workflows/ci.yml)
[![Coverage Status](https://coveralls.io/repos/github/wavevision/nette-tests/badge.svg?branch=master)](https://coveralls.io/github/wavevision/nette-tests?branch=master)
[![PHPStan](https://img.shields.io/badge/style-level%20max-brightgreen.svg?label=phpstan)](https://github.com/phpstan/phpstan)

[PHPUnit](https://github.com/sebastianbergmann/phpunit/) extension for testing [Nette](https://github.com/nette/nette)
applications.

## Install

```
composer require --dev wavevision/nette-tests
```

## Configuration

Add callback for creating `Nette\Configurator` to [bootstrap](tests/app/tests/bootstrap.php) for tests.

## Features

* [DI container](tests/app/tests/Models/ExampleModelTest.php) in tests, allow
  services [injects](tests/app/tests/Models/ExampleModelTest.php) in tests
* [presenter](tests/app/tests/Presenters/ExamplePresenterTest.php) testing
* [form](tests/app/tests/Presenters/FormPresenterTest.php) submit testing

## Learn

See [this great talk](https://www.youtube.com/watch?v=E1r0EhTkWn4) by [Jakub Filla](https://github.com/jfilla) to learn
basic concepts of this extension.
