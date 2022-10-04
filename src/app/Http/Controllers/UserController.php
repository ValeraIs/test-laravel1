<?php

namespace App\Http\Controllers;

use App\Actions\UpdateUserAction;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        private readonly UpdateUserAction $updateUserAction
    ) {}

    public function update(UpdateUserRequest $updateUserRequest): Response
    {
        /** @var User $user */
        $user = Auth::user();

        return $this->response()
            ->resource(new UserResource($this->updateUserAction->execute($user, $updateUserRequest->createDto())));
    }
}
