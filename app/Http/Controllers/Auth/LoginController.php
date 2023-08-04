<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        if (Auth::user()->role_as == '1') {
            return redirect('/dashboard')->with('message', 'Welcome to your dashboard');
        } elseif (Auth::user()->role_as == '0') {
            return response()->json(['message' => 'Logged in successfully'], 200);
        }  
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //google login
    public function retirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $this->_registerOrLoginUser($user);
        //return home after login
        return redirect('/');
    }


    // //facebook login
    // public function retirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // //facebook callback
    // public function handleFacebookCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();

        // $this->_registerOrLoginUser($user);
         //return home after login
        // return redirect()->route('home');
    // }

    //github login
    public function retirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    //github callback
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $this->_registerOrLoginUser($user);
        //return home after login
        return redirect('/home');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email',$data->email)->first();
        if (!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }

}
