<p align="center">
  <img style="padding: 25px" height="50" src="./art/circle-so-plus-php.png">
</p>

<p align="center">
  <a href="https://packagist.org/packages/adrosoftware/circle-so-api-php-sdk">
    <img alt="Latest Stable Version" src="https://poser.pugx.org/adrosoftware/circle-so-api-php-sdk/v/stable">
  </a>
  <a href="https://codecov.io/gh/adrosoftware/circle-so-api-php-sdk" > 
    <img src="https://codecov.io/gh/adrosoftware/circle-so-api-php-sdk/branch/main/graph/badge.svg?token=SI4NXOC1AX"/> 
  </a>
  <a href="https://github.com/adrosoftware/circle-so-api-php-sdk/actions/workflows/ci.yml">
    <img alt="Test - PHPUnit" src="https://github.com/adrosoftware/circle-so-api-php-sdk/actions/workflows/ci.yml/badge.svg">
  </a>
  <a href="https://github.com/adrosoftware/circle-so-api-php-sdk/blob/main/LICENSE">
    <img alt="License" src="https://img.shields.io/github/license/adrosoftware/circle-so-api-php-sdk">
  </a>
  <img alt="Last commit" src="https://img.shields.io/github/last-commit/adrosoftware/circle-so-api-php-sdk.svg">
</p>

# Unofficial [Circle](https://www.circle.so/) SDK for PHP

This is a simple Object Oriented wrapper for the [Circle](https://www.circle.so/) API, written with PHP. The full Circle API documentation can be found [here](https://api.circle.so).

## Requirements

* PHP >= 8.1
* A [PSR-17 implementation](https://packagist.org/providers/psr/http-factory-implementation)
* A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

## How to use it

> This package is decoupled from any HTTP messaging client with help by [HTTPlug](https://httplug.io). For this reason you need to install a PSR-17 and PSR-18 implementation packages. Example: `composer require symfony/http-client nyholm/psr7`.

Require the package with [composer](https://getcomposer.org/):

```bash
composer require adrosoftware/circle-so-api-php-sdk
```

Create an instance on your codebase as follows and then you will be good to start interacting with the Circle API.

```php
<?php

declare(strict_types=1);

use AdroSoftware\CircleSoSdk\CircleSo;

$circleSo = new CircleSo('5up3r53cr3770k3n');

// or

$circleSo = CircleSo::make('5up3r53cr3770k3n');

// Interact with the API.

$me = $circleSo->me()->info();

$member = $circleSo->members()
    ->search(
        email: 'adro@example.com',
        communityId: 456,
    );

$member = $circleSo->members()
    ->show(
        id: 123,
        communityId: 456,
    );
```

## License

This package is licensed under the MIT License - see the [LICENSE](https://github.com/adrosoftware/circle-so-api-php-sdk/blob/main/LICENSE) file for details

## Maintainers

This library is maintained by:
- [Adro Morelos](https://github.com/adrorocker)

## Contributors

See all the contributors [here](https://github.com/adrosoftware/circle-so-api-php-sdk/graphs/contributors)