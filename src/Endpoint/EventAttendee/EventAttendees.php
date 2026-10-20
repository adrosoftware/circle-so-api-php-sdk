<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\EventAttendee;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class EventAttendees extends AbstractEndpoint implements EndpointInterface
{
    public function all(
        int $eventId,
        ?int $communityId = null,
        ?int $perPage = null,
        ?int $page = null,
    ): mixed {
        return $this->request('GET', '/event_attendees', [
            ...$this->communityQuery($communityId),
            'event_id' => $eventId,
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }

    public function rsvp(int $eventId, string $memberEmail, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/event_attendees', [
            ...$this->communityQuery($communityId),
            'event_id' => $eventId,
            'member_email' => $memberEmail,
        ]);
    }

    public function remove(int $eventId, string $memberEmail, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', '/event_attendees', [
            ...$this->communityQuery($communityId),
            'event_id' => $eventId,
            'member_email' => $memberEmail,
        ]);
    }
}
