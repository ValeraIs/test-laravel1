<?php

namespace App\Http\Requests\Auth;

use App\Dto\Auth\RegistrationDto;
use App\Http\Requests\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'string', 'min:6'],
            'password_confirmation' => ['required'],
        ];
    }

    public function createDto(): RegistrationDto
    {
        return RegistrationDto::create($this->validated());
    }
}
