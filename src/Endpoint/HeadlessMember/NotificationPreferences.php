<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class NotificationPreferences extends AbstractEndpoint implements EndpointInterface
{
    /** Get notification preferences for a medium */
    public function getNotificationPreferencesForAMedium(int|string $medium): mixed
    {
        return $this->request('GET', "/notification_preferences/{$medium}");
    }

    /** Update notification preferences for a medium */
    /** @param array<string, mixed> $query */
    public function updateNotificationPreferencesForAMedium(int|string $medium, array $query = []): mixed
    {
        return $this->request('PUT', "/notification_preferences/{$medium}", $query);
    }

    /** Get space notification preferences for the provided space member ID */
    public function getSpaceNotificationPreferencesForTheProvidedSpaceMemberId(int|string $id): mixed
    {
        return $this->request('GET', "/notification_preferences/space_members/{$id}");
    }

    /** Update notification preferences for all the spaces for the community member for the provided medium */
    /** @param array<string, mixed> $query */
    public function updateAllSpaces(
        int|string $notificationPreferenceMedium,
        array $query = [],
    ): mixed {
        return $this->request('PUT', "/notification_preferences/{$notificationPreferenceMedium}/spaces", $query);
    }

    /** Update notification preferences for a space member for the provided medium */
    /** @param array<string, mixed> $query */
    public function updateSpace(
        int|string $notificationPreferenceMedium,
        int|string $id,
        array $query = [],
    ): mixed {
        return $this->request('PUT', "/notification_preferences/{$notificationPreferenceMedium}/spaces/{$id}", $query);
    }
}
