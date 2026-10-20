<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint;

final class RawEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed>|null $data
     */
    public function call(string $method, string $path, array $query = [], ?array $data = null): mixed
    {
        return $this->request($method, '/' . ltrim($path, '/'), $query, $data);
    }
}
