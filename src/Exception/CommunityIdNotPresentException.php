<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Exception;

use Exception;
use Throwable;

/**
 * This exceptions is thrown when a the `$comminityId` is not set.
 */
class CommunityIdNotPresentException extends Exception
{
    public function __construct(
        string $message = "The 'communityId' needs to be defined",
        int $code = 500,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
