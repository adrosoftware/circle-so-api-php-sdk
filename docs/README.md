# Unofficial Circle SDK for PHP

This is a Object Oriented wrapper for the [Circle](https://www.circle.so/) API, written with PHP. The full Circle API documentation can be found [here](https://api.circle.so).

## Circle API

From [Circle API documentation](https://api.circle.so): 

>The Circle API allows community admins to perform programmatic actions on or retrieve data from their community.
>
>The main purpose of the Circle API is to allow Circle's community admins to build bulk automations, migration scripts, and access data for reporting purposes. Our API is not meant to be used on the browser/client side, or to re-create your own Circle app from scratch.

## Why?

The [Circle](https://circle.so) team currently has no official SDK. Having an sdk help developers be more productive. Even when the [official documentation](https://api.circle.so) has nice examples on how to interact with the API with different technologies it is easier to just have a single instance to interact with all the endpoints. 

Let's use the next examples found in the [official documentation](https://api.circle.so) using `curl` and `Guzzle`:

```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.circle.so/api/v1/me',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Token {{api_token}}'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

echo $response;

```

or:

```php
<?php

$client = new Client();

$headers = [
  'Authorization' => 'Token {{api_token}}'
];

$request = new Request('GET', 'https://app.circle.so/api/v1/me', $headers);

$res = $client->sendAsync($request)->wait();

echo $res->getBody();

```
Now lets compere it with using this package:

```php
<?php

$circleSo = CircleSo::make({{api_token}});

/** @var array $me */
$me = $circleSo->me()->info();
```

You can see the difference already.

Also there is another __important__ reason. When there is a bad response, like a `member not found`, instead of returning a `404` http response code the API returns a `200` response code with the body containing a `{success:false}` json response, this library catch this responses and convert them into proper exceptions.

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