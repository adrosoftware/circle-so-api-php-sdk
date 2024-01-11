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
        if ($communityId === null && $this->communityId === null) {
            throw new CommunityIdNotPresentException();
        }

        if ($this->communityId === null) {
            $this->communityId === $communityId;
        }
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
