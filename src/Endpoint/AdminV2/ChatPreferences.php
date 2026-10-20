<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ChatPreferences extends AbstractEndpoint implements EndpointInterface
{
    /** Update Chat Preferences */
    /** @param array<string, mixed> $data */
    public function updateChatPreferences(array $data = []): mixed
    {
        return $this->request('PUT', "/chat_preferences", [], $data);
    }
}
