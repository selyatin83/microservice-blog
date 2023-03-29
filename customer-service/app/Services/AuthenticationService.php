<?php

namespace App\Services;

use App\DataTypes\User\TokenDataType;
use App\Dictionaries\UserTokenDictionary;
use App\Exceptions\TryingUnauthorizedAccessException;
use App\Interfaces\Services\AuthenticationServiceInterface;
use App\Traits\NeedAuthenticateTrait;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;
use DateTimeImmutable;
use DateInterval;

/**
 * @author <Mikhail Selyatin>
 */
class AuthenticationService implements AuthenticationServiceInterface
{
    use NeedAuthenticateTrait;

    /**
     * @param Request $request
     *
     * @return TokenDataType
     * @throws TryingUnauthorizedAccessException if user not authorized
     */
    public function buildToken(Request $request): TokenDataType
    {
        $this->needAuthenticate();

        /** @var User $user */
        $user = $request->user();
        $user->tokens()->delete(); //@todo while 1 user - 1 token

        $expiresAtToken = (new DateTimeImmutable())
            ->add(DateInterval::createFromDateString(config("sanctum.expiration") . ' minutes'));

        $token = $user->createToken(UserTokenDictionary::NAME_TOKEN_FOR_AUTH);

        return TokenDataType::create(
            $token->plainTextToken,
            $expiresAtToken
        );
    }
}