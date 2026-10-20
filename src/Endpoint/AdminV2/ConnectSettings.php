<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ConnectSettings extends AbstractEndpoint implements EndpointInterface
{
    /** Get Connect settings */
    public function getConnectSettings(): mixed
    {
        return $this->request('GET', "/settings/connect");
    }

    /** Update Connect settings */
    /** @param array<string, mixed> $data */
    public function updateConnectSettings(array $data = []): mixed
    {
        return $this->request('PATCH', "/settings/connect", [], $data);
    }
}
