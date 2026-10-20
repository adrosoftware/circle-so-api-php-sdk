<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Cookies extends AbstractEndpoint implements EndpointInterface
{
    /** Create cookies */
    public function createCookies(): mixed
    {
        return $this->request('POST', "/cookies");
    }

    /** Destroy cookies */
    public function destroyCookies(): mixed
    {
        return $this->request('DELETE', "/cookies");
    }
}
