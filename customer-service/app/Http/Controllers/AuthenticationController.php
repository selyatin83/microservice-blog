<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\SignUpUserRequest;
use App\Http\Responses\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Error;
use ErrorException;
use Throwable;

class AuthenticationController extends Controller
{
    /**
     * Register a user
     *
     * @param SignUpUserRequest $request
     * @return Response
     */
    public function signUp(
        SignUpUserRequest $request
    ): Response {
        try {

        } catch (Exception $e) {
            return new JsonResponse($e, 400);
        } catch (Error|Throwable $e) {
            return new JsonResponse(
                new ErrorException(
                    self::SERVER_ERROR_MESSAGE,
                    $e->getCode()
                ),
                500
            );
        }
    }
}
