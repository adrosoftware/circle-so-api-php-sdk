<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Traits;

use AdroSoftware\CircleSoSdk\CircleSo;

trait SdkInstance
{
    public function test_circle_so_sdk_instance(): void
    {
        $this->assertInstanceOf(
            CircleSo::class,
            $this->getSdkWithMockedClient()
        );
    }
}
