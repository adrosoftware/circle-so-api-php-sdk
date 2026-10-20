<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class FlaggedContents extends AbstractEndpoint implements EndpointInterface
{
    /** Flag content */
    /** @param array<string, mixed> $data */
    public function flagContent(array $data = []): mixed
    {
        return $this->request('POST', "/flagged_contents", [], $data);
    }
}
