<?php

namespace App\Http\Requests\User;

use App\Dto\User\UpdateUserDto;
use App\Enums\Lang;
use App\Http\Requests\FormRequest;
use DateTimeZone;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'lang' => ['required', new Enum(Lang::class)],
            'timezone' => ['required', Rule::in(DateTimeZone::listIdentifiers())],
        ];
    }

    public function createDto(): UpdateUserDto
    {
        return UpdateUserDto::create($this->validated());
    }
}
