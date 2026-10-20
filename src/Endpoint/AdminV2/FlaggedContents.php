<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class FlaggedContents extends AbstractEndpoint implements EndpointInterface
{
    /** Report Flagged Content */
    /** @param array<string, mixed> $data */
    public function reportFlaggedContent(array $data = []): mixed
    {
        return $this->request('POST', "/flagged_contents", [], $data);
    }

    /** List Flagged Contents */
    /** @param array<string, mixed> $query */
    public function listFlaggedContents(array $query = []): mixed
    {
        return $this->request('GET', "/flagged_contents", $query);
    }
}
