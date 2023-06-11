<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class authController extends Controller {

    public function login(Request $request) {

        $validate = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->failResponse('Validation Error', $validate->errors());
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->failResponse('Unauthorized', ['error' => 'Email Or Password Invalid'], 401);
        }

        $user = Auth::user();

        $success['token'] = $user->createToken('AuthToken')->plainTextToken;
        $success['user'] = $user;
        
        return $this->successResponse('Login Successfully', $success);

    }

    public function logout() {
        Auth::user()->tokens()->delete();
        return $this->successResponse('Logout Successfully');
    }


}
