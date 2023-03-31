<?php

namespace AdroSoftware\CircleSoSdk\Response;

interface FactoryInterface
{
    public function factor(?array $response = null): mixed;
}
