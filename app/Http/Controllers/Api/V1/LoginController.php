<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class LoginController extends Controller {
    public function login( Request $request ) {

        $credentials = $request->only( ['email', 'password'] );
        if ( !$token = auth()->attempt( $credentials ) ) {
            return error( 'Email & password dose not match', 401 );
        }
        $permissions = Role::find( auth()->user()->role_id )->permissions->
            pluck( 'name' )->toArray();

        $token = auth()->user()->createToken( 'auth_token', $permissions )->
            plainTextToken;
        return ok( 'Success', [
            'token'       => $token,
            'user'        => auth()->user(),
            'permissions' => $permissions,
        ] );

    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return ok( 'Logout success' );
    }
}
