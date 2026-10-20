<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\{Admin, AdminV2, CircleSo};

final class AdminTest extends TestCase
{
    public function test_it_creates_the_v2_admin_client_by_default(): void
    {
        self::assertInstanceOf(AdminV2::class, Admin::make('secret'));
    }

    public function test_it_creates_the_requested_admin_client_version(): void
    {
        self::assertInstanceOf(CircleSo::class, Admin::make('secret', version: 1));
        self::assertInstanceOf(AdminV2::class, Admin::make('secret', version: 2));
    }

    public function test_it_rejects_an_unknown_admin_api_version(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Admin API version must be 1 or 2.');

        Admin::make('secret', version: 3);
    }
}
