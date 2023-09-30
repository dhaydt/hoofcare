<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        if(auth()->user()){
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function redirectToFacebookProvider(){
        return Socialite::driver('facebook')->scopes([
            'public_profile', 'pages_show_list', 'pages_read_engagement', 'pages_manage_posts', 'pages_manage_metadata', 'user_videos', 'user_posts'
        ])->redirect();
    }

    public function hadnleProviderFacebookCallback(Request $request){
        $auth_user = Socialite::driver('facebook')->user();
        $user = User::where('id', Auth::id())->first();
        $user->fb_token = $auth_user->token;
        $user->fb_id = $auth_user->id;
        $user->save();

        return redirect()->route('user.profile');
    }

    public function facebook_page_id(Request $request){
        $input = $request->all();
        $rules = [
            'facebook_page_id' => 'required'
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            $arr = ['status' => 400, 'msg' => $validator->errors()->first(), 'result'=> []];
        }else{
            try{
                $user = User::find(auth()->id());
                $user->page_id = $request->facebook_page_id;
                $user->save();

                $msg = 'Page ID updated successfully';

                $arr = ['status' => 200, "msg" => $msg];
            }catch(Exception $ex){
                $msg = $ex->getMessage();

                if(isset($ex->errorInfo[2])){
                    $msg = $ex->errorInfo[2];
                }

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return response()->json($arr);
    }

    public function post(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->with('error', 'Password or email not correct!');
    }

    //tambahkan script di bawah ini
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    //tambahkan script di bawah ini 
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();
            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if ($user != null) {
                \auth()->login($user, true);
                return redirect()->route('home');
            } else {
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'login_with'        => 'google',
                    'sosmed_id'        => $user_google->id,
                    'avatar'        => $user_google->avatar,
                    'sosmed_token'        => $user_google->token,
                    'profile_url'        => $user_google->avatar,
                    'password'          => 0,
                    'email_verified_at' => now()
                ]);


                \auth()->login($create, true);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public function handlefbProviderCallback(Request $request){
        try {
            $user_google    = Socialite::driver('facebook')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if ($user != null) {
                $user->fb_token = $user_google->token;
                $user->fb_id = $user_google->id;
                $user->save();

                \auth()->login($user, true);
                return redirect()->route('auth.profile');
            } else {
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'login_with'        => 'facebook',
                    'fb_id'        => $user_google->id,
                    'avatar'        => $user_google->avatar,
                    'fb_token'        => $user_google->token,
                    'profile_url'        => $user_google->profile_url,
                    'password'          => 0,
                    'email_verified_at' => now()
                ]);


                \auth()->login($create, true);
                return redirect()->route('auth.profile');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
