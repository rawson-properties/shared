<?php

namespace Rawson\Shared\Http\Controllers;

use Auth;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Cookie;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Two\User as SocialiteUser;
use Rawson\Shared\Libs\OAuth;
use Socialite;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    private const COOKIE_PREVIOUS_PROVIDER = 'auth-previous-provider';

    public static function handleUser(SocialiteUser $u): User
    {
        $user = User::firstOrNew([
            'email' => $u->getEmail(),
        ]);

        $user->fill([
            'name' => $u->getName(),
            'last_seen_at' => now(),
            'access_token' => data_get($u, 'token'),
            'token_created_at' => now(),
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
        $previousProviderKey = $request->cookie(self::COOKIE_PREVIOUS_PROVIDER) ?: 'rawsoncoza';

        $providers = collect(config('oauth.providers'))
            ->filter(function ($e) {
                return $e['enabled'];
            })
            ->map(function ($e, $k) use ($previousProviderKey) {
                return (object) [
                    'name' => $e['name'],
                    'key' => $k,
                    'selected' => $k == $previousProviderKey,
                ];
            });

        if ($providers->count() === 1) {
            $request->merge([
                'provider' => $providers->first()->key,
            ]);

            return $this->connect($request);
        } else {
            return view('auth.login', [
                'providers' => $providers,
            ]);
        }
    }

    public function connect(Request $request)
    {
        $providerKey = $request->input('provider', 'rawsoncoza');
        $providerConfig = OAuth::getSetConfig($providerKey);

        Cookie::queue(self::COOKIE_PREVIOUS_PROVIDER, $providerKey);

        return Socialite::driver('google')
            ->with([
                'hd' => $providerConfig['domain'],
                'access_type' => 'offline',
                'prompt' => 'select_account',
            ])
            ->scopes(config('services.oauth.scopes', config('oauth.scopes')))
            ->redirect()
            ;
    }

    public function callback(Request $request)
    {
        $providerKey = Str::of($request->input('hd'))->replace('.', '');
        OAuth::getSetConfig($providerKey);

        try {
            $u = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            if ($request->has('error_message')) {
                abort(500, $request->input('error_message'));
            }

            throw $e;
        }

        abort_unless(config('services.google.domain') === Str::after($u->getEmail(), '@'), 500, 'Invalid OAuth domain!');

        static::handleUser($u);

        return redirect()->intended(route('welcome'));
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
