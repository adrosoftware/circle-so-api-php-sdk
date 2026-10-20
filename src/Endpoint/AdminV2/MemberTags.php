<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class MemberTags extends AbstractEndpoint implements EndpointInterface
{
    /** Create Member Tag */
    /** @param array<string, mixed> $data */
    public function createMemberTag(array $data): mixed
    {
        return $this->request('POST', "/member_tags", [], $data);
    }

    /** Member Tags List */
    /** @param array<string, mixed> $query */
    public function memberTagsList(array $query = []): mixed
    {
        return $this->request('GET', "/member_tags", $query);
    }

    /** Deletes a member tag */
    public function deletesAMemberTag(int|string $id): mixed
    {
        return $this->request('DELETE', "/member_tags/{$id}");
    }

    /** Shows a member tag's details */
    public function showsAMemberTagsDetails(int|string $id): mixed
    {
        return $this->request('GET', "/member_tags/{$id}");
    }

    /** Update member tag */
    /** @param array<string, mixed> $data */
    public function updateMemberTag(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/member_tags/{$id}", [], $data);
    }
}
