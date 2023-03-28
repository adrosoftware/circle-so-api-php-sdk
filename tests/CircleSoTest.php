<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\CircleSo;

class CircleSoTest extends TestCase
{
    public function test_circle_so_sdk_instance(): void
    {
        $this->assertInstanceOf(
            CircleSo::class,
            $this->sdk(
                $this->mockedClient()
            )
        );
    }
}
