<?php

namespace App\Services;

use App\Http\Resources\Models\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    /**
     * @throws \Exception
     */
    public function register(array $data): UserResource
    {
        $data['password'] = Hash::make($data['password']);
        $data['date_of_birth'] = new \DateTime($data['date_of_birth']);
        return UserResource::make(User::create($data));
    }

    public function login(string $email, string $password): string
    {
        $user = User::whereEmail($email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('user-token')->plainTextToken;
    }
}
