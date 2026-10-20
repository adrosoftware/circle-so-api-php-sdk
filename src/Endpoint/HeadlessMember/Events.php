<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Events extends AbstractEndpoint implements EndpointInterface
{
    /** Get list of community events */
    /** @param array<string, mixed> $query */
    public function getListOfCommunityEvents(array $query = []): mixed
    {
        return $this->request('GET', "/community_events", $query);
    }

    /** Create an event attendee */
    public function createAnEventAttendee(int|string $eventId): mixed
    {
        return $this->request('POST', "/events/{$eventId}/event_attendees");
    }

    /** Destroy an event attendee */
    public function destroyAnEventAttendee(int|string $eventId): mixed
    {
        return $this->request('DELETE', "/events/{$eventId}/event_attendees");
    }

    /** List event attendees */
    /** @param array<string, mixed> $query */
    public function listEventAttendees(int|string $eventId, array $query = []): mixed
    {
        return $this->request('GET', "/events/{$eventId}/event_attendees", $query);
    }

    /** List recurring events */
    /** @param array<string, mixed> $query */
    public function listRecurringEvents(int|string $spaceId, int|string $eventId, array $query = []): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/events/{$eventId}/recurring_events", $query);
    }

    /** Update recurring event RSVP for the provided event ids */
    /** @param array<string, mixed> $data */
    public function updateRecurringEventRsvp(
        int|string $spaceId,
        int|string $eventId,
        array $data = [],
    ): mixed {
        return $this->request('PUT', "/spaces/{$spaceId}/events/{$eventId}/recurring_events/rsvp", [], $data);
    }
}
