<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class GitHubController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }


    public function gitCallback()
    {
        try {

            $user = Socialite::driver('github')->user();

            $searchUser = User::where('github_id', $user->id)->first();

            if ($searchUser) {

                Auth::login($searchUser);

                return redirect('/dashboard');

            } else {
                $gitUser = User::create([
                    'name' => $user->nickname,
                    'email' => $user->getEmail(),
                    'github_id'=> $user->getId(),
                    'auth_type'=> 'github',
                    'password' => encrypt('gitpwd059')
                ]);

                Auth::login($gitUser);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
