<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint;

use AdroSoftware\CircleSoSdk\CircleSo;

interface EndpointInterface
{
    public function __construct(CircleSo $circleSo, ?int $communityId = null);
    public function communityId(int $communityId): static;
}
