<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Error;
use ErrorException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Error $e) {
            return new JsonResponse(
                new ErrorException(
                    Controller::SERVER_ERROR_MESSAGE,
                    $e->getCode()
                ),
                500
            );
        });
    }
}
