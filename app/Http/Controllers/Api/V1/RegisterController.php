<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function register( RegisterRequest $request )
    {
        $user = User::create( [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ] );

        $token = $user->createToken( 'auth_token' )->plainTextToken;
        $data  = [
            'user'  => $user,
            'token' => $token,
        ];

        return ok( 'Hello World', $data );
    }
}

