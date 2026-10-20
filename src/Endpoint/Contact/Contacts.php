<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Contact;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Contacts extends AbstractEndpoint implements EndpointInterface
{
    /** @param array<string, mixed> $data */
    public function create(array $data): mixed
    {
        return $this->request('POST', '/contacts', data: $data);
    }
}
