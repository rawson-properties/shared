@extends('layouts.app')

@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">How to get connected:</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ config('app.name') }} uses Google Sign-In.</h6>

                    <p class="card-text">
                        Google Sign-In is a secure authentication system. It enables you to sign-in with your Rawson Google account, the same account you already use with Gmail and other Google services.
                    </p>

                    <p class="card-text">
                        When you click the 'Sign-In' button below you will be redirected to a Google Sign-In page which prompts you to enter your <code>@rawson.co.za</code> account details. Once you do so successfully you will be redirected back to {{ config('app.name') }} and be authenticated.
                    </p>

                    <p class="card-text">
                        There's no need to create a new account and no new password to remember. Your authentication details are safely handled by Google.
                    </p>

                    <a href="{{ route('auth.connect') }}" class="btn btn-primary btn-lg btn-block">Sign-In</a>
                </div>
            </div>
        </div>
    </div>
@endsection
