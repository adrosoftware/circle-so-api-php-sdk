<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Http\Message;

use Psr\Http\Message\ResponseInterface;

final class ArrayTransformer implements ResponseTransformerInterface
{
    public function transform(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
