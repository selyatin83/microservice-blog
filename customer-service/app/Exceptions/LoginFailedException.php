<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * @author <Mikhail Selyatin>
 */
class LoginFailedException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = "Login user is failing. Credentials is wrong or empty.",
        int $code = 0,
        ?Throwable $previous = null
    )  {
        parent::__construct($message, $code, $previous);
    }
}