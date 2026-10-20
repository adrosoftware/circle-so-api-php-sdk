<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Messages extends AbstractEndpoint implements EndpointInterface
{
    /** Create Message */
    /** @param array<string, mixed> $data */
    public function createMessage(array $data = []): mixed
    {
        return $this->request('POST', "/messages", [], $data);
    }
}
