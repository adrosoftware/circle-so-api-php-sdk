<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ChatThreads extends AbstractEndpoint implements EndpointInterface
{
    /** List chat threads */
    /** @param array<string, mixed> $query */
    public function listChatThreads(array $query = []): mixed
    {
        return $this->request('GET', "/chat_threads", $query);
    }

    /** Get chat thread */
    public function getChatThread(int|string $id): mixed
    {
        return $this->request('GET', "/chat_threads/{$id}");
    }

    /** Get unread chat threads */
    public function getUnreadChatThreads(): mixed
    {
        return $this->request('GET', "/chat_threads/unread_chat_threads");
    }
}
