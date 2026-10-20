<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Paywalls extends AbstractEndpoint implements EndpointInterface
{
    /** Search Paywalls */
    /** @param array<string, mixed> $query */
    public function searchPaywalls(array $query = []): mixed
    {
        return $this->request('GET', "/paywalls/search", $query);
    }

    /** Deletes a paywall */
    public function deletesAPaywall(int|string $id): mixed
    {
        return $this->request('DELETE', "/paywalls/{$id}");
    }

    /** Archives a paywall */
    public function archivesAPaywall(int|string $id): mixed
    {
        return $this->request('PUT', "/paywalls/{$id}/archive");
    }

    /** Syncs a legacy paywall's member access */
    public function syncsALegacyPaywallsMemberAccess(int|string $paywallId): mixed
    {
        return $this->request('POST', "/paywalls/{$paywallId}/member_access_syncs");
    }

    /** Publishes a paywall */
    public function publishesAPaywall(int|string $id): mixed
    {
        return $this->request('PUT', "/paywalls/{$id}/publish");
    }

    /** Unarchives a paywall */
    public function unarchivesAPaywall(int|string $id): mixed
    {
        return $this->request('PUT', "/paywalls/{$id}/unarchive");
    }
}
