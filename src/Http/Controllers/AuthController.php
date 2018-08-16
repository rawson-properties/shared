<?php

namespace Rawson\Shared\Http\Controllers;

use Auth;
use App\Models\User;
use Carbon\Carbon;
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

        $user->fill([
            'name' => $u->getName(),
            'access_token' => data_get($u, 'token'),
            'token_created_at' => Carbon::now(),
            'token_expires_in' => data_get($u, 'expiresIn', 0),
            'refresh_token' => data_get($u, 'refreshToken', $user->refresh_token),
        ]);

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
            ->with([
                'hd' => 'rawson.co.za',
                'access_type' => 'offline',
            ])
            ->scopes(config('services.google.scopes', []))
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

        if (!in_array(str_after($u->getEmail(), '@'), [
            'rawson.co.za',
            'rawsoncommercial.com',
            'rawsonproperties.com',
            'rawsonrentals.com',
        ])) {
            return abort(500, 'Invalid OAuth domain!');
        }

        self::handleUser($u);

        return redirect()->intended(route('welcome'));
    }

    public function connection(Request $request)
    {
        $person = $request->user()->rt3Person;
        $activeAgents = collect();
        if ($person) {
            $activeAgents = $person
                ->employee
                ->agents()
                ->isActive()
                ->with([ 'office', ])
                ->get()
                ;
        }

        return view('auth.connection', [
            'activeAgents' => $activeAgents,
        ]);
    }

    public function connectionPost(Request $request)
    {
        $this->validate($request, [
            'rt3_agent_id' => 'required',
        ]);

        session([ 'user.default_rt3_agent_id' => $request->input('rt3_agent_id'), ]);

        return redirect()->route('auth.connection');
    }
}
