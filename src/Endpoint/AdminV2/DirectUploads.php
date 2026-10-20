<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class DirectUploads extends AbstractEndpoint implements EndpointInterface
{
    /** Create Direct Upload */
    /** @param array<string, mixed> $data */
    public function createDirectUpload(array $data = []): mixed
    {
        return $this->request('POST', "/direct_uploads", [], $data);
    }
}
