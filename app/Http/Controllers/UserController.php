<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile(){
        $data['title'] = 'Profile';
        $data['active'] = 'profile';

        $data['category'] = Category::get();

        return view('pages.profile', $data);
    }

    public function updateProfile(Request $request){
        if($request->password){
            $data = $request->only('email', 'password');
            $validate = Validator::make($data, [
                'password' => 'min:6',
            ], [
                'password.min:6' => 'Minimal 6 Characters!',
            ]);

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Minimal password 6 characters');
            }

            if($request->password !== $request->c_password){
                return redirect()->back()->with('error', 'Password not same!');
            }

        }
        $user = User::find(auth()->id());
        $user->name = $request->name;

        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
