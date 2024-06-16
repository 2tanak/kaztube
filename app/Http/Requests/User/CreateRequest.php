<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * CreateUserRequest
 *
 * @property-read string $password
 */
class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'     => ['string', 'max:255', 'required'],
            'email'    => ['string', 'max:255', 'required','email','unique:users,email'],
            'position' => ['string', 'max:255', 'nullable'],
            'password' => ['string', 'max:255', 'required', 'min:8'],
        ];
    }
}
