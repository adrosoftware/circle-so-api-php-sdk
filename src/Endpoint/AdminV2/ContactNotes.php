<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ContactNotes extends AbstractEndpoint implements EndpointInterface
{
    /** Create Contact Note */
    /** @param array<string, mixed> $data */
    public function createContactNote(int|string $contactId, array $data): mixed
    {
        return $this->request('POST', "/contacts/{$contactId}/contact_notes", [], $data);
    }

    /** List Contact Notes */
    /** @param array<string, mixed> $query */
    public function listContactNotes(int|string $contactId, array $query = []): mixed
    {
        return $this->request('GET', "/contacts/{$contactId}/contact_notes", $query);
    }
}
