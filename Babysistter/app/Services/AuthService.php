<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function login(LoginRequest $request)
    {
        $this->guard()->factory()->setTTL(24*60);


        if (!$token = $this->guard()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        $this->guard()->logout();
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());

    }//end refresh()


    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL() * 60),
                'user'          => Auth::user(),
            ]
        );

    }//end respondWithToken()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()

}

