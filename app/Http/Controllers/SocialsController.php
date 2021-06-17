<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SocialAuth;

class SocialsController extends Controller
{
    public function auth($provider)
    {
        return SocialAuth::authorize($provider);
    }
    public function auth_redirect($provider)
    {
        SocialAuth::login($provider,function($user,$details){

            $user->name=$details->full_name;
            $user->email=$details->email;
            $user->avatar=$details->avatar;

            $user->save();
        });

        return redirect('/home');
    }
}
