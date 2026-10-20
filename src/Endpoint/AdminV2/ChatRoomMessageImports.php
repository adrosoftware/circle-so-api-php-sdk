<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ChatRoomMessageImports extends AbstractEndpoint implements EndpointInterface
{
    /** Import Chat Room Message */
    /** @param array<string, mixed> $data */
    public function importChatRoomMessage(array $data): mixed
    {
        return $this->request('POST', "/chat_room_message_imports", [], $data);
    }
}
