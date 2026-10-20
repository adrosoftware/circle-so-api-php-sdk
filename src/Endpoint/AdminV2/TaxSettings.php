<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class TaxSettings extends AbstractEndpoint implements EndpointInterface
{
    /** Get tax settings */
    public function getTaxSettings(): mixed
    {
        return $this->request('GET', "/tax_setting");
    }

    /** Update tax settings */
    /** @param array<string, mixed> $data */
    public function updateTaxSettings(array $data = []): mixed
    {
        return $this->request('PUT', "/tax_setting", [], $data);
    }
}
