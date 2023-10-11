<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile_update(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
        ], [
            'email.required' => 'Email cannot be empty!',
            'name.required' => 'Name cannot be empty!',
        ]);
        
        if ($validator->fails()) {
            return response()->json(Helpers::error_processor($validator, 403, false, 'error', null), 403);
        }

        $user = $request->user();
        $user = User::find($user['id']);

            if($request->password){
                $validator = Validator::make($request->all(), [
                    'new_password' => 'required|min:6',
                ], [
                    'new_password.required' => 'Required!',
                ]);
                
                if ($validator->fails()) {
                    return response()->json(Helpers::error_processor($validator, 403, false, 'error', null), 403);
                }

                $user->password = Hash::make($request->new_password);
            }

        if($request->name == ''){
            return redirect()->back()->with('error', 'Name cannot be empty!');
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->occupation = $request->occupation;

        $user->save();
        return response()->json(Helpers::response_format(200, true, "success", ["message" => 'Profile updated successfully']));
    }
}
