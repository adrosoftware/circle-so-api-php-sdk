<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Embeds extends AbstractEndpoint implements EndpointInterface
{
    /** Create Embed */
    /** @param array<string, mixed> $data */
    public function createEmbed(array $data = []): mixed
    {
        return $this->request('POST', "/embeds", [], $data);
    }

    /** Get Embed */
    public function getEmbed(int|string $sgid): mixed
    {
        return $this->request('GET', "/embeds/{$sgid}");
    }
}
