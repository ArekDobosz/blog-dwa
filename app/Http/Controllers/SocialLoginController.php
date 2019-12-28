<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Auth;

class SocialLoginController extends Controller
{
 	public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
    	$userData = Socialite::driver($provider)->user();

    	if ($provider === 'google') {
    		$user = User::where('google_id', $userData->id)->first();
    	}
    	if ($provider === 'facebook') {
    		$user = User::where('facebook_id', $userData->id)->first();
    	}

    	if(!$user) {
    		$user = User::create([
    			'name' => $userData->name,
    			'email' => $userData->email,
    		]);

    		if ($provider === 'google') {
    			$user->google_id = $userData->id;
	    	}
	    	if ($provider === 'facebook') {
	    		$user->facebook_id = $userData->id;
	    	}
	    	$user->save();
    	}
    	Auth::guard('user')->login($user);
    	
    	return redirect()->to('/');
    }


}
