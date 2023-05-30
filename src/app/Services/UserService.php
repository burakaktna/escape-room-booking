<?php

namespace App\Services;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    /**
     * @throws Exception
     */
    public function register(array $data): UserResource
    {
        try {
            $data['password'] = Hash::make($data['password']);
            return UserResource::make(User::create($data));
        } catch (Exception $e) {
            throw new Exception("User could not be registered: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function login(array $data): string
    {
        try {
            $email = $data['email'];
            $password = $data['password'];
            $user = User::whereEmail($email)->firstOrFail();

            if (!Hash::check($password, $user->password)) {
                throw new Exception('The provided credentials are incorrect.');
            }

            return $user->createToken('user-token')->plainTextToken;
        } catch (ModelNotFoundException $e) {
            throw new Exception("The user with this email does not exist.");
        } catch (Exception $e) {
            throw new Exception("Could not log in: " . $e->getMessage());
        }
    }
}
