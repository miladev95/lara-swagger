# Laravel Swagger

[![Latest Stable Version](https://poser.pugx.org/miladev/lara-swagger/v)](//packagist.org/packages/miladev/lara-setting)
[![License](https://poser.pugx.org/miladev/lara-swagger/license)](//packagist.org/packages/miladev/lara-setting)
[![Total Downloads](https://poser.pugx.org/miladev/lara-swagger/downloads)](//packagist.org/packages/miladev/lara-setting)

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

## Roadmap

- Support enum types
- Support all kind of migrations (Rename,Delete,...)

If you want to contribute, open a pull request by following Laravel contribution guide.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.