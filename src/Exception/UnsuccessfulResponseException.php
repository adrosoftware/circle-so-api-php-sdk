<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Exception;

use Exception;
use Throwable;

/**
 * This exceptions is thrown when a response is not successful.
 */
class UnsuccessfulResponseException extends Exception
{
    public function __construct(
        string $message = "The request did not return a successful response.",
        int $code = 500,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
