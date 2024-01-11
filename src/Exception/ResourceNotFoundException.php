<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Exception;

use Exception;
use Throwable;

class ResourceNotFoundException extends Exception
{
    public function __construct(
        string $message = "The resource was not found.",
        int $code = 404,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
