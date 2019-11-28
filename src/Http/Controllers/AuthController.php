<?php

namespace Rawson\Shared\Http\Controllers;

use Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        if ($user->wasRecentlyCreated) {
            event(new Registered($user));
        }

        return $user;
    }

    /*
     * Set a cookie on this page that says we've seen the message.
     * If the cookie existed, just redirect to auth without showing.
     */
    public function login(Request $request)
    {
        $response = $request->cookie('auth-seen')
            ? redirect(route('auth.connect'))
            : response()->view('auth.login')
            ;

        return $response->cookie('auth-seen', 'true', 7200);
    }

    public function connect()
    {
        return Socialite::driver('google')
            ->with([
                'hd' => 'rawson.co.za',
                'access_type' => 'offline',
                'prompt' => 'select_account',
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

        abort_unless('rawson.co.za' === Str::after($u->getEmail(), '@'), 500, 'Invalid OAuth domain!');

        self::handleUser($u);

        return redirect()->route('welcome');
    }

    public function connection(Request $request)
    {
        $person = $request->user()->rt3Person;
        $activeAgents = collect();
        if ($person && $person->employee) {
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
