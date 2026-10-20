<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class TaggedMembers extends AbstractEndpoint implements EndpointInterface
{
    /** Create Tagged Member */
    /** @param array<string, mixed> $data */
    public function createTaggedMember(array $data = []): mixed
    {
        return $this->request('POST', "/tagged_members", [], $data);
    }

    /** Delete Tagged Member */
    /** @param array<string, mixed> $query */
    public function deleteTaggedMember(array $query = []): mixed
    {
        return $this->request('DELETE', "/tagged_members", $query);
    }

    /** List Tagged Members */
    /** @param array<string, mixed> $query */
    public function listTaggedMembers(array $query = []): mixed
    {
        return $this->request('GET', "/tagged_members", $query);
    }

    /** Get Tagged Member */
    public function getTaggedMember(int|string $id): mixed
    {
        return $this->request('GET', "/tagged_members/{$id}");
    }
}
