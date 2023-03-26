<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\SignUpUserRequest;
use App\Http\Responses\JsonResponse;
use App\Interfaces\Factories\UserFactoryInterface;
use App\ValueObjects\Email;
use App\ValueObjects\Id;
use App\ValueObjects\Password;
use Illuminate\Support\Facades\Log;
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
     * @param UserFactoryInterface $userFactory
     *
     * @return Response
     */
    public function signUp(
        SignUpUserRequest    $request,
        UserFactoryInterface $userFactory
    ): Response {
        try {
            $params = $request->safe()->all();
            $email = Email::create($params['email']);
            $password = Password::create($params['password']);
            $login = $params['login'] ?? null;
            $name = $params['name'];
            $lastName = $params['lastName'];

            $user = $userFactory->create(
                Id::generate(),
                $email,
                $password,
                $name,
                $lastName,
                $login
            );

            Log::info(
                "Success creating user",
                [
                    'method'  => __METHOD__,
                    'user'    => $user,
                    'request' => $request->all(),
                ]
            );
            return new JsonResponse($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            Log::warning(
                'Failed creating user',
                [
                    'message' => $e->getMessage(),
                    'method'  => __METHOD__,
                    'request' => $request->all(),
                    'trace'   => $e->getTraceAsString()
                ]
            );

            return new JsonResponse($e, 400);
        } catch (Error|Throwable $e) {
            Log::error(
                $e->getMessage(),
                [
                    'method'  => __METHOD__,
                    'request' => $request->all(),
                    'trace'   => $e->getTraceAsString()
                ]
            );

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
