<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Notifications extends AbstractEndpoint implements EndpointInterface
{
    /** Archive a notification */
    public function archiveANotification(int|string $id): mixed
    {
        return $this->request('POST', "/notifications/{$id}/archive");
    }

    /** Delete a notification */
    public function deleteANotification(int|string $id): mixed
    {
        return $this->request('DELETE', "/notifications/{$id}");
    }

    /** Get a paginated list of notifications */
    /** @param array<string, mixed> $query */
    public function getAPaginatedListOfNotifications(array $query = []): mixed
    {
        return $this->request('GET', "/notifications", $query);
    }

    /** Mark all notifications as read */
    /** @param array<string, mixed> $data */
    public function markAllNotificationsAsRead(array $data = []): mixed
    {
        return $this->request('POST', "/notifications/mark_all_as_read", [], $data);
    }

    /** Mark a notification as read */
    public function markANotificationAsRead(int|string $id): mixed
    {
        return $this->request('POST', "/notifications/{$id}/mark_as_read");
    }

    /** Get new notifications count */
    public function getNewNotificationsCount(): mixed
    {
        return $this->request('GET', "/notifications/new_notifications_count");
    }

    /** Reset new notifications count */
    public function resetNewNotificationsCount(): mixed
    {
        return $this->request('POST', "/notifications/reset_new_notifications_count");
    }
}
