<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Live extends AbstractEndpoint implements EndpointInterface
{
    /** List Live Rooms */
    /** @param array<string, mixed> $query */
    public function listLiveRooms(array $query = []): mixed
    {
        return $this->request('GET', "/live/rooms", $query);
    }

    /** List Live Room Transcripts */
    public function listLiveRoomTranscripts(int|string $roomId): mixed
    {
        return $this->request('GET', "/live/rooms/{$roomId}/transcripts");
    }
}
