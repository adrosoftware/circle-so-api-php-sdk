<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ChatRoom extends AbstractEndpoint implements EndpointInterface
{
    /** Create chat room message */
    /** @param array<string, mixed> $data */
    public function createChatRoomMessage(int|string $chatRoomUuid, array $data = []): mixed
    {
        return $this->request('POST', "/messages/{$chatRoomUuid}/chat_room_messages", [], $data);
    }

    /** Fetch chat room messages */
    /** @param array<string, mixed> $query */
    public function fetchChatRoomMessages(int|string $chatRoomUuid, array $query = []): mixed
    {
        return $this->request('GET', "/messages/{$chatRoomUuid}/chat_room_messages", $query);
    }

    /** Delete chat room message */
    public function deleteChatRoomMessage(int|string $chatRoomUuid, int|string $id): mixed
    {
        return $this->request('DELETE', "/messages/{$chatRoomUuid}/chat_room_messages/{$id}");
    }

    /** Get chat room message */
    public function getChatRoomMessage(int|string $chatRoomUuid, int|string $id): mixed
    {
        return $this->request('GET', "/messages/{$chatRoomUuid}/chat_room_messages/{$id}");
    }

    /** Update chat room message */
    /** @param array<string, mixed> $data */
    public function updateChatRoomMessage(int|string $chatRoomUuid, int|string $id, array $data = []): mixed
    {
        return $this->request('PUT', "/messages/{$chatRoomUuid}/chat_room_messages/{$id}", [], $data);
    }

    /** Get chat room participants */
    /** @param array<string, mixed> $query */
    public function getChatRoomParticipants(int|string $chatRoomUuid, array $query = []): mixed
    {
        return $this->request('GET', "/messages/{$chatRoomUuid}/chat_room_participants", $query);
    }

    /** Update chat room participant */
    /** @param array<string, mixed> $data */
    public function updateChatRoomParticipant(int|string $chatRoomUuid, int|string $id, array $data = []): mixed
    {
        return $this->request('PUT', "/messages/{$chatRoomUuid}/chat_room_participants/{$id}", [], $data);
    }

    /** Create a chat room */
    /** @param array<string, mixed> $data */
    public function createAChatRoom(array $data = []): mixed
    {
        return $this->request('POST', "/messages", [], $data);
    }

    /** Get chat rooms */
    /** @param array<string, mixed> $query */
    public function getChatRooms(array $query = []): mixed
    {
        return $this->request('GET', "/messages", $query);
    }

    /** Mark all messages in a chat room as read */
    public function markAllMessagesInAChatRoomAsRead(int|string $uuid): mixed
    {
        return $this->request('POST', "/messages/{$uuid}/mark_all_as_read");
    }

    /** Get chat room details */
    public function getChatRoomDetails(int|string $uuid): mixed
    {
        return $this->request('GET', "/messages/{$uuid}");
    }

    /** Get unread chat rooms */
    public function getUnreadChatRooms(): mixed
    {
        return $this->request('GET', "/messages/unread_chat_rooms");
    }

    /** Create a reaction on a chat room message */
    /** @param array<string, mixed> $data */
    public function createAReactionOnAChatRoomMessage(array $data = []): mixed
    {
        return $this->request('POST', "/reactions", [], $data);
    }

    /** Remove a reaction from a chat room message */
    /** @param array<string, mixed> $data */
    public function removeAReactionFromAChatRoomMessage(array $data = []): mixed
    {
        return $this->request('DELETE', "/reactions", [], $data);
    }
}
