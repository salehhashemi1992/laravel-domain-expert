# Laravel Domain Expert

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salehhashemi/laravel-domain-expert.svg?style=flat-square)](https://packagist.org/packages/salehhashemi/laravel-domain-expert)
[![Total Downloads](https://img.shields.io/packagist/dt/salehhashemi/laravel-domain-expert.svg?style=flat-square)](https://packagist.org/packages/salehhashemi/laravel-domain-expert)
[![GitHub Actions](https://img.shields.io/github/actions/workflow/status/salehhashemi1992/laravel-domain-expert/run-tests.yml?branch=master&label=code%20style)](https://github.com/salehhashemi1992/laravel-domain-expert/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/salehhashemi1992/laravel-domain-expert/fix-php-code-style-issues.yml?branch=master&label=code%20style)](https://github.com/salehhashemi1992/laravel-domain-expert/actions/workflows/fix-php-code-style-issues.yml)

Laravel Domain Expert is a package that helps you create and manage domain-driven directory structures in your Laravel application. It automates the process of setting up a new domain with the necessary folders, a controller, and a simple route file with a route group and a domain prefix.

## Installation

To install Laravel Domain Expert, you can use Composer:

```bash
composer require salehhashemi/laravel-domain-expert
```

## Usage

To create a new domain directory structure, run the following command:
```bash
php artisan make:domain DomainName
```
Replace DomainName with the desired name for your domain.

The command will create a domain directory structure in your Laravel application, including a sample controller and a simple route file with a route group and a domain prefix.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Saleh Hashemi](https://github.com/salehhashemi1992)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.