# Unofficial Circle SDK for PHP

This is a Object Oriented wrapper for the [Circle](https://www.circle.so/) API, written with PHP. The full Circle API documentation can be found [here](https://api.circle.so).

## Circle API

From [Circle API documentation](https://api.circle.so): 

>The Circle API allows community admins to perform programmatic actions on or retrieve data from their community.
>
>The main purpose of the Circle API is to allow Circle's community admins to build bulk automations, migration scripts, and access data for reporting purposes. Our API is not meant to be used on the browser/client side, or to re-create your own Circle app from scratch.

## Easy use

Require the package with [composer](https://getcomposer.org/):

```bash
composer require adrosoftware/circle-so-api-php-sdk
```

Create an instance on your codebase as follows and then you will be good to start interacting with the Circle API.

```php
<?php

declare(strict_types=1);

use AdroSoftware\CircleSoSdk\CircleSo;

$circleSo = CircleSo::make('5up3r53cr3770k3n');

// Interact with the API.

$me = $circleSo->me()->info();
```

## License

This package is licensed under the MIT License - see the [LICENSE](https://github.com/adrosoftware/circle-so-api-php-sdk/blob/main/LICENSE) file for details

## Maintainers

This library is maintained by:
- [Adro Morelos](https://github.com/adrorocker)

## Contributors

See all the contributors [here](https://github.com/adrosoftware/circle-so-api-php-sdk/graphs/contributors)