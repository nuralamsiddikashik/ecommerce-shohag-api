<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller {
    public function login( Request $request ) {

        $credentials = $request->only( ['email', 'password'] );
        if ( !$token = auth()->attempt( $credentials ) ) {
            return error( 'Email & password dose not match', 401 );
        }

        $token = auth()->user()->createToken( 'auth_token' )->plainTextToken;
        return ok( 'Success', [
            'token' => $token,
            'user'  => auth()->user(),
        ] );

    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return ok( 'Logout success' );
    }
}
