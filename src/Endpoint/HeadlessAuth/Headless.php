<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessAuth;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Headless extends AbstractEndpoint implements EndpointInterface
{
    /** Refresh an access token */
    /** @param array<string, mixed> $data */
    public function refreshAnAccessToken(array $data): mixed
    {
        return $this->request('PATCH', "/access_token/refresh", [], $data);
    }

    /** Revoke an access token */
    /** @param array<string, mixed> $data */
    public function revokeAnAccessToken(array $data): mixed
    {
        return $this->request('POST', "/access_token/revoke", [], $data);
    }

    /** Create/Get an auth token */
    /** @param array<string, mixed> $data */
    public function createGetAnAuthToken(array $data): mixed
    {
        return $this->request('POST', "/auth_token", [], $data);
    }

    /** Revoke a refresh token */
    /** @param array<string, mixed> $data */
    public function revokeARefreshToken(array $data): mixed
    {
        return $this->request('POST', "/refresh_token/revoke", [], $data);
    }
}
