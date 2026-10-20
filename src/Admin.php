<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

final class Admin
{
    private function __construct()
    {
    }

    /** @param int $version Admin API version (1 or 2). */
    public static function make(
        string $token,
        ?Options $options = null,
        int $version = 2,
    ): CircleSo|AdminV2 {
        return match ($version) {
            1 => CircleSo::make($token, ($options ?? new Options())->withApiVersion('v1')),
            2 => AdminV2::make($token, $options),
            default => throw new \InvalidArgumentException('Admin API version must be 1 or 2.'),
        };
    }
}
