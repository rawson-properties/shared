@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4 mt-5">
                <div class="card p-4">
                    <div class="card-body text-center">
                        <div class="row justify-content-center mb-5">
                            <div class="col-8">
                                <img
                                    src="{{ asset('/images/rawson-tab-logo.png') }}"
                                    style="max-width: 150px;"
                                    title=""
                                >
                            </div>
                        </div>

                        <h5 class="font-weight-normal mb-4">Quick question before you log in</h4>

                        <p class="card-text text-muted mb-5 text-justify">
                            Please confirm which region you're operating in so we can send you to the correct Google sign in page.
                        </p>

                        @foreach ($providers as $e)
                            @continue(!$e->selected)

                            <a
                                href="{{ route('auth.connect', [ 'provider' => $e->key, ]) }}"
                                class="btn btn-dark btn-lg btn-block"
                            >{{ $e->name }}</a>
                        @endforeach

                        @foreach ($providers as $e)
                            @continue($e->selected)

                            <a
                                href="{{ route('auth.connect', [ 'provider' => $e->key, ]) }}"
                                class="btn btn-outline-dark btn-lg btn-block"
                            >{{ $e->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
