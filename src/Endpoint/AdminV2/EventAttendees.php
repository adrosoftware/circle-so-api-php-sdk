<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class EventAttendees extends AbstractEndpoint implements EndpointInterface
{
    /** Create Event Attendee */
    /** @param array<string, mixed> $data */
    public function createEventAttendee(array $data = []): mixed
    {
        return $this->request('POST', "/event_attendees", [], $data);
    }

    /** Delete Event Attendee */
    /** @param array<string, mixed> $data */
    public function deleteEventAttendee(array $data = []): mixed
    {
        return $this->request('DELETE', "/event_attendees", [], $data);
    }

    /** List Event Attendees */
    /** @param array<string, mixed> $query */
    public function listEventAttendees(array $query = []): mixed
    {
        return $this->request('GET', "/event_attendees", $query);
    }
}
