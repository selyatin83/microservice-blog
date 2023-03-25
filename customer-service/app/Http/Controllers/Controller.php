<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /** @var string  */
    protected const SERVER_ERROR_MESSAGE = "Oops, something went wrong. Try later.";

    use AuthorizesRequests, ValidatesRequests;
}
