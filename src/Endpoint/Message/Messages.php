<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Message;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Messages extends AbstractEndpoint implements EndpointInterface
{
    /** @param array<string> $userEmails */
    public function group(array $userEmails, string $message, ?int $communityId = null): mixed
    {
        return $this->request(
            'POST',
            '/messages',
            [...$this->communityQuery($communityId), 'message_body' => $message],
            ['user_emails' => $userEmails],
        );
    }

    public function direct(string $userEmail, string $message, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/messages', [
            ...$this->communityQuery($communityId),
            'user_email' => $userEmail,
            'message_body' => $message,
        ]);
    }
}
