<?php

namespace App\Interfaces\Services;

use App\DataTypes\User\TokenDataType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author <Mikhail Selyatin>
 */
interface AuthenticationServiceInterface
{
    /**
     * @param Request $request
     *
     * @return TokenDataType
     */
    public function buildToken(Request $request): TokenDataType;
}