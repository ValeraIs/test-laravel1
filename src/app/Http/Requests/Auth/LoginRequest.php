<?php

namespace App\Http\Requests\Auth;

use App\Dto\Auth\LoginDto;
use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        if (! Auth::attempt($this->only('email', 'password'))) {

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }

    public function createDto(): LoginDto
    {
        return LoginDto::create($this->validated());
    }
}
