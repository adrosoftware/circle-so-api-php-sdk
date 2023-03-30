<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint;

final class Me extends AbstractEndpoint
{
    public function get(): array
    {
        return $this->decodeContent(
            $this->circleSo->getHttpClient()->get('/me')
        );
    }
}
