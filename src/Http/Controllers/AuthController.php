<?php

namespace Rawson\Shared\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Two\User as SocialiteUser;
use Socialite;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public static function handleUser(SocialiteUser $u): User
    {
        $user = User::firstOrNew([
            'email' => $u->getEmail(),
        ]);

        $user->name = $u->getName();
        $user->save();

        Auth::login($user);
        return $user;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function connect()
    {
        return Socialite::driver('google')
            ->with([ 'hd' => 'rawson.co.za', ])
            ->redirect()
            ;
    }

    public function callback(Request $request)
    {
        try {
            $u = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            if ($request->has('error_message')) {
                abort(500, $request->input('error_message'));
            }

            throw $e;
        }

        if (!in_array(str_after($u->getEmail(), '@'), [ 'rawson.co.za', 'rawsonproperties.com', ])) {
            return abort(500, 'Invalid OAuth domain!');
        }

        self::handleUser($u);

        return redirect()->intended(route('welcome'));
    }
}
