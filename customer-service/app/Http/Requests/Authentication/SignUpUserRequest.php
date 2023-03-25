<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Requests\BaseRequestApi;

class SignUpUserRequest extends BaseRequestApi
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
            'email' => "string|unique:users|required|email|lowercase",
            'password' => "string|min:8|max:32|confirmed|required"
        ];
    }
}
