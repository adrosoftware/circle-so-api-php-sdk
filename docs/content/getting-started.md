## Requirements

* PHP >= 8.1
* A [PSR-17 implementation](https://packagist.org/providers/psr/http-factory-implementation)
* A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

!> This package is decoupled from any HTTP messaging client with the help of [HTTPlug](https://httplug.io). For this reason you need to install a PSR-17 and PSR-18 implementation packages. Example: `composer require symfony/http-client nyholm/psr7`.

## Install

Require the package with [composer](https://getcomposer.org/):

```bash
composer require adrosoftware/circle-so-api-php-sdk
```

## Example usage

Create an instance on your codebase as follows and then you will be good to start interacting with the Circle API.

```php
<?php

declare(strict_types=1);

use AdroSoftware\CircleSoSdk\CircleSo;

$circleSo = new CircleSo('5up3r53cr3770k3n');
// or using static make method
$circleSo = CircleSo::make('5up3r53cr3770k3n');

// Interact with the API.

$me = $circleSo->me()->info();
```
## More usage examples

For more detail usage please refer to the [Usage](content/usage/configuration.md) section.