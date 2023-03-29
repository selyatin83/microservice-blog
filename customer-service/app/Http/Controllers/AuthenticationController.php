<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginFailedException;
use App\Http\Requests\Authentication\SignInUserRequest;
use App\Http\Requests\Authentication\SignUpUserRequest;
use App\Http\Responses\JsonResponse;
use App\Interfaces\Factories\UserFactoryInterface;
use App\Interfaces\Services\AuthenticationServiceInterface;
use App\ValueObjects\User\Email;
use App\ValueObjects\User\Id;
use App\ValueObjects\User\Password;
use Error;
use ErrorException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * @author <Mikhail Selyatin>
 */
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
            return new JsonResponse(
                [
                    'user' => $user
                ],
                Response::HTTP_CREATED
            );
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


    /**
     * Login a user by Email and Password
     *
     * @param SignInUserRequest $request
     * @param AuthenticationServiceInterface $authenticationService
     *
     * @return Response
     * @todo Will need to authenticate by login and password later
     */
    public function signIn(
        SignInUserRequest              $request,
        AuthenticationServiceInterface $authenticationService
    ): Response {
        try {
            $credentials = $request->safe()->all();

            if (!Auth::attempt($credentials)) {
                throw new LoginFailedException();
            }

            $tokenDataType = $authenticationService->buildToken($request);

            return new JsonResponse(
                [
                    'user'  => Auth::user()->toArray(),
                    'token' => $tokenDataType
                ]
            );
        } catch (Exception $e) {
            Log::warning(
                'Failed login user',
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
