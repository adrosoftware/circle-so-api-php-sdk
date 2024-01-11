<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Me;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Me extends AbstractEndpoint implements EndpointInterface
{
    public function info(): mixed
    {
        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get('/me')
        );
    }
}
