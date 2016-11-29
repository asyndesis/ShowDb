<?php

namespace ShowDb\Http\Controllers\Auth;

use ShowDb\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ShowDb\User;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return \Socialize::with('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
	$user = \Socialize::with('facebook')->user();

	$authUser = $this->findOrCreateUser($user);

	\Auth::login($authUser, true);

	echo \Auth::user()->name;
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $user
     * @return User
     */
    private function findOrCreateUser($user)
    {
        if ($authUser = User::where('email', $user->email)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->id,
            'avatar' => $user->avatar
        ]);
    }
}