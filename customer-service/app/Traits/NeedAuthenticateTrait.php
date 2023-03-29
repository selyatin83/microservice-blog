<?php

namespace App\Traits;

use App\Exceptions\TryingUnauthorizedAccessException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * @author <Mikhail Selyatin>
 */
trait NeedAuthenticateTrait
{
    /**
     * @return void
     * @throws TryingUnauthorizedAccessException
     */
    protected function needAuthenticate(): void
    {
        Auth::user() ?? throw new TryingUnauthorizedAccessException();
    }
}