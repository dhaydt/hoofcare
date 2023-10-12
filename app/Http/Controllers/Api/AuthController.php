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
    public function login_google(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'token' => 'required',
            'google_id' => 'required',
        ], [
            'email.required' => 'Please input email!',
            'name.required' => 'Please input name!',
            'token.required' => 'Please input token!',
            'google_id.required' => 'Please input facebook id!',
        ]);

        if ($validator->fails()) {
            return response()->json(Helpers::error_processor($validator, 403, false, 'error', null), 403);
        }

        $check = User::where(['email' => $request->email])->first();
        if (!$check) {
            $create = User::Create([
                'email'             => $request->email,
                'name'              => $request->name,
                'login_with'        => 'google',
                'fb_id'        => $request->google_id,
                'avatar'        => null,
                'fb_token'        => $request->token,
                'profile_url'        => null,
                'password'          => 0,
                'user_is'          => 'user',
                'email_verified_at' => now()
            ]);

            $check =  User::where(['email' => $request->email])->first();

            $token = $check->createToken('auth_token')->plainTextToken;

            if ($check['user_is'] == 'user') {
                return response()->json(Helpers::response_format(200, true, "success", ["access_token" => $token, "user" => $check]));
            }

            return response()
                ->json(['status' => 'error', 'message' => 'Your credential is registered as administrator!'], 200);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($user['user_is'] == 'user') {
            return response()->json(Helpers::response_format(200, true, "success", ["access_token" => $token, "user" => $user]));
        }

        return response()->json(Helpers::response_format(403, false, "Something wrong, contact administrator", null));
    }

    public function login_facebook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'token' => 'required',
            'facebook_id' => 'required',
        ], [
            'email.required' => 'Please input email!',
            'name.required' => 'Please input name!',
            'token.required' => 'Please input token!',
            'facebook_id.required' => 'Please input facebook id!',
        ]);

        if ($validator->fails()) {
            return response()->json(Helpers::error_processor($validator, 403, false, 'error', null), 403);
        }

        $check = User::where(['email' => $request->email])->first();
        if (!$check) {
            $create = User::Create([
                'email'             => $request->email,
                'name'              => $request->name,
                'login_with'        => 'facebook',
                'fb_id'        => $request->facebook_id,
                'avatar'        => null,
                'fb_token'        => $request->token,
                'profile_url'        => null,
                'password'          => 0,
                'user_is'          => 'user',
                'email_verified_at' => now()
            ]);

            $check =  User::where(['email' => $request->email])->first();

            $token = $check->createToken('auth_token')->plainTextToken;

            if ($check['user_is'] == 'user') {
                return response()->json(Helpers::response_format(200, true, "success", ["access_token" => $token, "user" => $check]));
            }

            return response()->json(['status' => 'error', 'message' => 'Your credential is registered as administrator!'], 200);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($user['user_is'] == 'user') {
            return response()->json(Helpers::response_format(200, true, "success", ["access_token" => $token, "user" => $user]));
        }

        return response()->json(Helpers::response_format(403, false, "Something wrong, contact administrator", null));
    }
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
        if (!$check) {
            return response()
                ->json(['status' => 'error', 'message' => 'Customer not found!'], 401);
        }
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()
                ->json(['status' => 'error', 'message' => 'Wrong password!'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($user['user_is'] == 'user') {
            return response()->json(Helpers::response_format(200, true, "success", ["access_token" => $token, "user" => $user]));
        }
        return response()->json(Helpers::response_format(403, false, "Something wrong, contact administrator", null));
    }
}
