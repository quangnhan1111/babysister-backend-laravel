<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    private $authService;
    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authService=new AuthService();

    }//end __construct()


    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->login($request);

    }//end login()

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'User logged out successfully']);

    }//end logout()

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required|string|between:2,100',
                'email'    => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
                'date_of_birth' => 'before:today',
                'address' => 'required|max:255',
                'phone' => 'required|min:11|numeric',
                'type' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                ['error'  => 'Unprocessable Entity'],
                422
            );
        }

        $user = User::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );
        return response()->json(['message' => 'User created successfully', 'user' => $user]);

    }//end register()

}//end class
