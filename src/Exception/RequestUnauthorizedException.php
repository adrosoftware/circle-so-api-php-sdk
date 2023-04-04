<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Exception;

use Exception;
use Throwable;

/**
 * This exceptions is thrown when a the request is not authorized.
 */
class RequestUnauthorizedException extends Exception
{
    public function __construct(
        string $message = "The request was not authorized.",
        int $code = 500,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
