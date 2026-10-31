<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create($data);

        return $this->withToken($user);
    }

    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            abort(401, 'Email and/or password invalid');
        }

        return $this->withToken($user);
    }

    private function withToken(User $user): array
    {
        return [
            'token' => $user->createToken('api')->plainTextToken,
            'user'  => UserResource::make($user),
        ];
    }
}
