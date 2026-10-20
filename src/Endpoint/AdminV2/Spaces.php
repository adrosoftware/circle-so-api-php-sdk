<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Spaces extends AbstractEndpoint implements EndpointInterface
{
    /** @param array<string, mixed> $query */
    public function all(array $query = []): mixed
    {
        return $this->listSpaces($query);
    }

    public function show(int|string $id): mixed
    {
        return $this->showASpace($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): mixed
    {
        return $this->createSpace($data);
    }

    /** @param array<string, mixed> $data */
    public function update(int|string $id, array $data): mixed
    {
        return $this->updateSpace($id, $data);
    }

    public function delete(int|string $id): mixed
    {
        return $this->deleteASpace($id);
    }

    /** @param array<string, mixed> $query */
    public function aiSummary(int|string $spaceId, array $query = []): mixed
    {
        return $this->summarizeASpace($spaceId, $query);
    }

    /** Summarize a space */
    /** @param array<string, mixed> $query */
    public function summarizeASpace(int|string $spaceId, array $query = []): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/ai_summaries", $query);
    }

    /** Create Space */
    /** @param array<string, mixed> $data */
    public function createSpace(array $data = []): mixed
    {
        return $this->request('POST', "/spaces", [], $data);
    }

    /** List Spaces */
    /** @param array<string, mixed> $query */
    public function listSpaces(array $query = []): mixed
    {
        return $this->request('GET', "/spaces", $query);
    }

    /** Delete a space */
    public function deleteASpace(int|string $id): mixed
    {
        return $this->request('DELETE', "/spaces/{$id}");
    }

    /** Show a space */
    public function showASpace(int|string $id): mixed
    {
        return $this->request('GET', "/spaces/{$id}");
    }

    /** Update Space */
    /** @param array<string, mixed> $data */
    public function updateSpace(int|string $id, array $data = []): mixed
    {
        return $this->request('PUT', "/spaces/{$id}", [], $data);
    }
}
