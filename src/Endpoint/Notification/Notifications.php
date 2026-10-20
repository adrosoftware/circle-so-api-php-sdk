<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Notification;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Notifications extends AbstractEndpoint implements EndpointInterface
{
    private const PUBLIC_BASE_URI = '/public';

    /** @param array<string, mixed> $query */
    public function unsubscribe(array $query): mixed
    {
        return $this->request('GET', self::PUBLIC_BASE_URI . '/unsubscribe', $query);
    }

    /** @param array<string, mixed> $query */
    public function preferences(array $query): mixed
    {
        return $this->request('GET', self::PUBLIC_BASE_URI . '/notification_preferences', $query);
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string, mixed> $query
     */
    public function updatePreferences(array $data, array $query = []): mixed
    {
        return $this->request(
            'PATCH',
            self::PUBLIC_BASE_URI . '/notification_preferences',
            $query,
            $data,
        );
    }
}
