<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // confirmed means that there must be a password_confirmation field in the request
        ];
    }
}