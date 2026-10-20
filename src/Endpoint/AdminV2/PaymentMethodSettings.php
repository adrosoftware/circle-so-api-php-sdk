<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class PaymentMethodSettings extends AbstractEndpoint implements EndpointInterface
{
    /** Retrieves the community's payment method preferences */
    public function retrievesTheCommunitysPaymentMethodPreferences(): mixed
    {
        return $this->request('GET', "/payment_method_setting");
    }
}
