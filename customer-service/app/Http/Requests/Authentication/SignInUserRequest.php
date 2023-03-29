<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Requests\BaseRequestApi;

/**
 * @author <Mikhail Selyatin>
 */
class SignInUserRequest extends BaseRequestApi
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => "string|required|email",
            'password' => "string|required",
        ];
    }
}
