<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $authService) {
        $this->service = $authService;
    }

    public function register(Request $request) {
        $result = false;
        $login = $request->post('login');
        $password = $request->post('password');

        try {
            $result = $this->service->registerUser($login, $password);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'an error occured when trying to register new user',
                'error' => $err
            ], 500);
        }

        if (! $result) {
            return response()->json([
                'message' => 'bad request'
            ], 400);
        }

        return response()->noContent();
    }

    public function login(Request $request){
        $login = $request->post('login');
        $password = $request->post('password');
        $token = "";

        try {
            $token = $this->service->authUser($login, $password);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'an error occured when trying to login user',
                'error' => $err
            ], 500);
        }

        if ($token === "") {
            return response()->json([
                'message' => 'bad request'
            ], 400);
        }

        return response()->json([
            'message' => 'user has successfully logged in',
            'token_type' => 'Bearer',
            'access_token' => $token
        ], 200);
    }
}
