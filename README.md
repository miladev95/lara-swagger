# Laravel Swagger

[![Latest Stable Version](https://poser.pugx.org/miladev/lara-swagger/v)](https://packagist.org/packages/miladev/lara-swagger)
[![License](https://poser.pugx.org/miladev/lara-swagger/license)](https://packagist.org/packages/miladev/lara-swagger)
[![Total Downloads](https://poser.pugx.org/miladev/lara-swagger/downloads)](https://packagist.org/packages/miladev/lara-swagger)
[![CI & Release](https://github.com/miladev95/lara-swagger/actions/workflows/ci-release.yml/badge.svg)](https://github.com/miladev95/lara-swagger/actions/workflows/ci-release.yml)

A Swagger model generator based on migrations

---
if you bored to create swagger models from your laravel application this package can help you.

## Installation

You can install the package via composer:

```bash
composer require miladev/lara-swagger
```
## Usage

```bash
php artisan lswagger:generate
```
This command will create swagger_models.js file which contains all models of your laravel application

## Testing

This package uses PHPUnit and Orchestra Testbench.

- Prerequisites: PHP 8.2+ and Composer
- Install dev dependencies:

```bash
composer install
```

If you do not have a global Composer installed, you can use a local PHAR inside the project:

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=. --filename=composer.phar
php -r "unlink('composer-setup.php');"
php composer.phar install
```

- Run the tests:

```bash
composer test
# or
vendor/bin/phpunit
# or a specific test file
vendor/bin/phpunit tests/Feature/CreateSwaggerCommandTest.php
```

If you run tests from an IDE, ensure the working directory is the project root so the generated `swagger_models.json` can be found.

## Roadmap

- Support enum types
- Support all kind of migrations (Rename,Delete,...)

If you want to contribute, open a pull request by following Laravel contribution guide.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.