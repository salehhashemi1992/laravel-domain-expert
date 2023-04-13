# Laravel Domain Expert

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salehhashemi/laravel-domain-expert.svg?style=flat-square)](https://packagist.org/packages/salehhashemi/laravel-domain-expert)
[![Total Downloads](https://img.shields.io/packagist/dt/salehhashemi/laravel-domain-expert.svg?style=flat-square)](https://packagist.org/packages/salehhashemi/laravel-domain-expert)
[![GitHub Actions](https://img.shields.io/github/actions/workflow/status/salehhashemi1992/laravel-domain-expert/run-tests.yml?branch=master&label=tests)](https://github.com/salehhashemi1992/laravel-domain-expert/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/salehhashemi1992/laravel-domain-expert/fix-php-code-style-issues.yml?branch=master&label=code%20style)](https://github.com/salehhashemi1992/laravel-domain-expert/actions/workflows/fix-php-code-style-issues.yml)
[![StyleCI](https://github.styleci.io/repos/625663475/shield?branch=master)](https://github.styleci.io/repos/625663475?branch=master)

Laravel Domain Expert is a package that helps you create and manage domain-driven directory structures in your Laravel application. It automates the process of setting up a new domain with the necessary folders, a controller, and a simple route file with a route group and a domain prefix.

## Installation

To install Laravel Domain Expert, you can use Composer:

```bash
composer require salehhashemi/laravel-domain-expert
```

## Usage

### Creating a new domain

To create a new domain directory structure, run the following command:
```bash
php artisan make:domain DomainName
```
Replace DomainName with the desired name for your domain.

The command will create a domain directory structure in your Laravel application, including a sample controller and a simple route file with a route group and a domain prefix.

### Domain Structure

When you create a new domain using the `php artisan make:domain DomainName` command, the following directory structure will be generated:

```Bash
Domains
└── DomainName
    ├── Exceptions
    ├── Http
    │   ├── Controllers
    │   │   ├── DomainNameController.php
    │   ├── Middleware
    │   └── Requests
    ├── Jobs
    ├── Models
    ├── Observers
    ├── Repositories
    ├── resources
    │   ├── css
    │   ├── js
    │   └── views
    ├── routes
    │   └── web.php
    └── Services
```

This structure helps you organize your code in a domain-driven manner, making it easier to manage and maintain as your application grows.

### Creating controllers within a domain
To create a new controller within a specific domain, use the -d or --domain flag:

```bash
php artisan make:controller ControllerName -d
```
or
```bash
php artisan make:controller ControllerName --domain
```
When using the -d or --domain flag, you will be prompted to select the domain you'd like to create the controller in.

## Auto-loading Routes and Views

The package includes built-in support for automatically loading routes and views for each domain. When your package is installed and the service provider is registered, the DomainAutoScanServiceProvider class will scan the Domains directory and automatically discover and load the route and view files for each domain.

### Example: Calling views in controllers
To reference a view within a domain, use the domain name as the namespace, followed by two colons and the view file path. Here's an example of how to call a view in a controller:

```php
return view('DomainName::view-name');
```

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