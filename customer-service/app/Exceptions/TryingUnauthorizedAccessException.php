<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * @author <Mikhail Selyatin>
 */
class TryingUnauthorizedAccessException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = "Trying unauthorized access, permission denied.",
        int $code = 0,
        ?Throwable $previous = null
    )  {
        parent::__construct($message, $code, $previous);
    }
}