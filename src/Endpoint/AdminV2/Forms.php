<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Forms extends AbstractEndpoint implements EndpointInterface
{
    /** Delete a form */
    public function deleteAForm(int|string $id): mixed
    {
        return $this->request('DELETE', "/forms/{$id}");
    }

    /** Show a form */
    public function showAForm(int|string $id): mixed
    {
        return $this->request('GET', "/forms/{$id}");
    }

    /** Update a form */
    /** @param array<string, mixed> $data */
    public function updateAForm(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/forms/{$id}", [], $data);
    }

    /** Duplicate a form */
    public function duplicateAForm(int|string $id): mixed
    {
        return $this->request('POST', "/forms/{$id}/duplicate");
    }

    /** List Forms */
    /** @param array<string, mixed> $query */
    public function listForms(array $query = []): mixed
    {
        return $this->request('GET', "/forms", $query);
    }

    /** Create a form submission */
    /** @param array<string, mixed> $data */
    public function createAFormSubmission(int|string $formId, array $data = []): mixed
    {
        return $this->request('POST', "/forms/{$formId}/submissions", [], $data);
    }

    /** List form submissions */
    /** @param array<string, mixed> $query */
    public function listFormSubmissions(int|string $formId, array $query = []): mixed
    {
        return $this->request('GET', "/forms/{$formId}/submissions", $query);
    }
}
