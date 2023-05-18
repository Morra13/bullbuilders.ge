<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialController
 * @package App\Http\Controllersъ
 */
class SocialController extends Controller
{
    /** @var string  */
    const ROUTE_GOOGLE_REDIRECT     = 'google.redirect';

    /** @var string  */
    const ROUTE_FACEBOOK_REDIRECT     = 'facebook.redirect';

    /**
     * Redirect to authorization in google
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function googleRedirect ()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Redirect to authorization in facebook
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
}
