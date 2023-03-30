<?php

namespace AdroSoftware\CircleSoSdk\Http\Message;

use Psr\Http\Message\ResponseInterface;

interface ResponseMediatorInterface
{
    public function __invoke(ResponseInterface $response): array|object|string|null;
}
