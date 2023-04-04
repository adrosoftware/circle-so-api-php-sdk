## Parameters

The `AdroSoftware\CircleSoSdk\CircleSo::class` client accepts 2 parameters.
* The required API token.
* And an optional `AdroSoftware\CircleSoSdk\Options::class` object. 

## Options

The API client can be customized through the `options` parameter.

The following options can be overridden:

* `response_factory`
* `user_agent`

By default a successful response will return an `array` containing the data returned by the API endpoint. You can create a class that convert that array into an object for example or into a string or even a spacial wrapper object. The created class need to implements the `AdroSoftware\CircleSoSdk\Response\FactoryInterface::class` interface

For this you will override the `response_factory` option like so:

```php
<?php

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Options;
use AdroSoftware\CircleSoSdk\Response\FactoryInterface;
use stdClass;

$factory = new class implements FactoryInterface {
    public function factor(?array $response = null): stdClass
    {
        return (object) $response;
    }
};

$options = new Options([
    'response_factory' => $factory,
]);

$circleSo = new CircleSo({{api_token}}, $options);

/** @var stdClass $me */
$me = $circleSo->me()->info();
```

By default the `user_agent` http header use to make the request to the API endpoint will have the value `adrosoftware/circle-so-api-php-sdk`. You can change this to the value is most convenient for you.

For this you will override the `user_agent` option like so:

```php
<?php

$options = new Options([
    'user_agent' => 'My Awesome App',
]);

$circleSo = new CircleSo({{api_token}}, $options);

/** @var array $me */
$me = $circleSo->me()->info();
```

