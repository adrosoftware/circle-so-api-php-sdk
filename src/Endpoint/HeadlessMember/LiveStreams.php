<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class LiveStreams extends AbstractEndpoint implements EndpointInterface
{
    /** Create a live stream room */
    /** @param array<string, mixed> $data */
    public function createALiveStreamRoom(array $data = []): mixed
    {
        return $this->request('POST', "/live_streams/rooms", [], $data);
    }
}
