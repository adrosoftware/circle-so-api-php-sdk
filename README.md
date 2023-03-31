# Unofficial [Circle](https://www.circle.so/) SDK for PHP

This is a PHP SDK to interact with the [Circle](https://www.circle.so/) API. Circle documentation can be found [here](https://api.circle.so).

## How to use it

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
