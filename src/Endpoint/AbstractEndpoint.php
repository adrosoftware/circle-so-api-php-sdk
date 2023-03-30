<?php

namespace AdroSoftware\CircleSoSdk\Endpoint;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractEndpoint implements EndpointInterface
{
    public function __construct(protected CircleSo $circleSo)
    {
    }

    protected function mediateResponse(ResponseInterface $response): array
    {
        return $this->circleSo->mediateResponse($response);
    }
}
