<?php

namespace AdroSoftware\CircleSoSdk\Http\Message;

use Psr\Http\Message\ResponseInterface;

class ResponseMediator implements ResponseMediatorInterface
{
    public function __invoke(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
