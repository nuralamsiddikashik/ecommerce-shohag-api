<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;

class RegisterController extends Controller {
    public function register( RegisterRequest $request ) {
        $role = Role::where( 'name', 'user' )->first();

        $user = User::create( [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role_id'  => $role->role_id,
        ] );

        $permissions = $role->permissions->pluck( 'name' )->toArray();
        $token       = $user->createToken( 'auth_token', $permissions )->
            plainTextToken;
        $data = [
            'user'  => $user,
            'token' => $token,
        ];

        return ok( 'Hello World', $data );
    }
}
