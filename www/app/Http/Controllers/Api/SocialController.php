<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialController
 * @package App\Http\Api\Controllers
 */
class SocialController extends Controller
{
    /** @var string  */
    const ROUTE_GOOGLE_CALLBACK     = 'api.google.callback';

    /** @var string  */
    const ROUTE_FACEBOOK_CALLBACK   = 'api.facebook.callback';

    /**
     * Log in from google
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function googleCallback ()
    {
        $googleUser = Socialite::driver('google')->user();

        $obUser = User::where('email', $googleUser->getEmail())->first();

        if ($obUser) {
            $obUser->google_id = $googleUser->getId();
            $obUser->save();
        } else {
            $obUser = User::where('google_id', $googleUser->getId())->first();

            if (!$obUser) {
                $obUser = User::create([
                    'name'          => $googleUser->name,
                    'email'         => $googleUser->email,
                    'nick_name'     => str_replace(['@', '.', '-'], '_', $googleUser->email),
                    'google_id'     => $googleUser->id,
                    'password'      => md5($googleUser->id),
                ]);
            }
        }

        Auth::login($obUser);

        return redirect()->route(\App\Http\Controllers\UserController::ROUTE_EDIT);
    }

    /**
     * Log in from facebook
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function facebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $obUser = User::where('email', $facebookUser->getEmail())->first();

        if ($obUser) {
            $obUser->facebook_id = $facebookUser->getId();
            $obUser->save();
        } else {
            $obUser = User::where('facebook_id', $facebookUser->id)->first();

            if (!$obUser) {
                $obUser = User::create([
                    'name'          => $facebookUser->name,
                    'email'         => $facebookUser->email,
                    'nick_name'     => str_replace(['@', '.', '-'], '_', $facebookUser->email),
                    'facebook_id'   => $facebookUser->id,
                    'password'      => md5($facebookUser->id),
                ]);
            }
        }

        Auth::login($obUser);


        return redirect()->route(\App\Http\Controllers\UserController::ROUTE_EDIT);
    }
}
