<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class DirectUploads extends AbstractEndpoint implements EndpointInterface
{
    /** Create a direct upload */
    /** @param array<string, mixed> $data */
    public function createADirectUpload(array $data = []): mixed
    {
        return $this->request('POST', "/direct_uploads", [], $data);
    }
}
