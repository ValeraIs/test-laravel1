<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Actions\CreateUserTokenAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        private readonly CreateUserAction      $createUserAction,
        private readonly CreateUserTokenAction $createUserTokenAction
    ) {}

    public function registration(RegistrationRequest $request): Response
    {
        $user = $this->createUserAction->execute($request->createDto());

        return $this->response()
            ->resource(new UserResource($user));
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): Response
    {
        $request->authenticate();

        return $this->response()
            ->data([
                'type_token' => 'Bearer',
                'access_token' => $this->createUserTokenAction->execute($request->createDto())
            ]);
    }
}
