<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\ProfileField;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ProfileFields extends AbstractEndpoint implements EndpointInterface
{
    public function all(string $pageName = 'edit_profile'): mixed
    {
        return $this->request('GET', '/page_profile_fields', ['page_name' => $pageName]);
    }
}
