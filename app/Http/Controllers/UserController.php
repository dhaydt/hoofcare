<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $user = User::find(auth()->id());

        if($request->password){
            $data = $request->only('email', 'password');
            $validate = Validator::make($data, [
                'name' => 'required',
                'password' => 'min:6',
            ], [
                'name.required' => "Your name is required",
                'password.min:6' => 'Minimal 6 Characters!',
            ]);

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Min 6 characters');
            }

            if($request->password !== $request->c_password){
                return redirect()->back()->with('error', 'Password not same!');
            }

            $user->password = Hash::make($request->password);
        }

        if($request->name == ''){
            return redirect()->back()->with('error', 'Name cannot be empty!');
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->occupation = $request->occupation;

        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
