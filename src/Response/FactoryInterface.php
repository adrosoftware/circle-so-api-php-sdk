<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Response;

interface FactoryInterface
{
    public function factor(?array $response = null): mixed;
}
