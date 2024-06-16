<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateUserRequest
 *
 * @property-read string $password
 */
class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'     => ['string', 'max:255'],
            'email'    => ['string', 'max:255','email','unique:users,email'],
            'position' => ['string', 'max:255','nullable'],
            'password' => ['string', 'max:255','nullable'],
        ];
    }
}
