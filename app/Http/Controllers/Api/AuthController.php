<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Please input email!',
            'password.required' => 'Password required!',
            'password.min' => 'Min length 6 characters!',
        ]);

        if ($validator->fails()) {
            return response()->json(Helpers::error_processor($validator, 403, false, 'error', null), 403);
        }
        $check = User::where(['email' => $request->email])->first();
        if(!$check){
            return response()
                ->json(['status' => 'error', 'message' => 'Customer not found!'], 401);
        }
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()
                ->json(['status' => 'error', 'message' => 'Wrong password!'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        if($user['user_is'] == 'user'){
            return response()->json(Helpers::response_format(200, true, "success", ["access_token" => $token, "user" => $user]));
        }
        return response()->json(Helpers::response_format(403, false, "Something wrong, contact administrator", null));
    }
}
