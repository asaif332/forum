<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;

class SocialLoginController extends Controller
{
    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authuser = User :: where('email' , $user->email)->first();

        if (!$authuser) {
            $authuser = User :: firstOrNew(['provider_id' => $user->getId()]);
            $authuser->email = $user->email;
        }
          
        $authuser->provider_id = $user->getId();
        $authuser->name = $user->name;
        $authuser->avatar = $user->avatar;
        $authuser->provider = $provider;

        if ($authuser->save()) {
            auth()->login($authuser);
            return redirect('/forum');
        }

        return redirect()->back();
        
    }

}
