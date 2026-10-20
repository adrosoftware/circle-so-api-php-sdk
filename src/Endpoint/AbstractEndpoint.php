<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    RequestUnauthorizedException,
    ResourceNotFoundException,
    UnsuccessfulResponseException,
};
use Psr\Http\Message\ResponseInterface;
use JsonException;

abstract class AbstractEndpoint
{
    public function __construct(protected CircleSo $circleSo, protected ?int $communityId = null)
    {
    }

    public function communityId(int $communityId): static
    {
        $this->communityId = $communityId;

        return $this;
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    protected function ensureCommunityIdIsPresent(?int $communityId = null): void
    {
        if ($communityId !== null) {
            $this->communityId = $communityId;
        }

        if ($this->communityId === null) {
            throw new CommunityIdNotPresentException();
        }
    }

    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed>|null $data
     * @throws JsonException
     */
    protected function request(
        string $method,
        string $path,
        array $query = [],
        ?array $data = null,
        bool $throwNotFoundException = false,
    ): mixed {
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null);
        $uri = $path;

        if ($query !== []) {
            $uri .= (str_contains($uri, '?') ? '&' : '?') . http_build_query(
                $query,
                '',
                '&',
                PHP_QUERY_RFC3986,
            );
        }

        $body = $data === null ? null : json_encode($data, JSON_THROW_ON_ERROR);
        $client = str_starts_with($path, '/public/')
            ? $this->circleSo->getHttpClient($this->circleSo->uri('https://app.circle.so/'))
            : $this->circleSo->getHttpClient();
        $response = match (strtoupper($method)) {
            'GET' => $client->get($uri),
            'POST' => $client->post($uri, [], $body),
            'PUT' => $client->put($uri, [], $body),
            'PATCH' => $client->patch($uri, [], $body),
            'DELETE' => $client->delete($uri, [], $body),
            default => throw new \InvalidArgumentException("Unsupported HTTP method: {$method}"),
        };

        return $this->factorResponse($response, $throwNotFoundException);
    }

    /**
     * @return array{community_id: int}
     */
    protected function communityQuery(?int $communityId = null): array
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return ['community_id' => $this->communityId];
    }

    /**
     * @throws ResourceNotFoundException
     * @throws RequestUnauthorizedException
     * @throws UnsuccessfulResponseException
     */
    protected function factorResponse(ResponseInterface $response, ?bool $throwNotFoundException = null): mixed
    {
        return $this->circleSo->factorResponse($response, $throwNotFoundException);
    }
}
