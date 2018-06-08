@extends('layouts.app')

@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-md-8 mt-5">
            <h1>Account Connection Status</h1>
            <hr>

            @if (Auth::user()->rt3Person)
                <p class="lead">
                    This account <small>({{ Auth::user()->email }})</small> has an active office of "<em>{{ Auth::user()->default_office->NAME }}</em>".
                </p>

                @if ($activeAgents && ($activeAgents->count() > 1))
                    <div class="card">
                        <div class="card-header">Change active Office</div>
                        <ul class="list-group list-group-flush">
                            @foreach ($activeAgents as $agent)
                                <li class="list-group-item">
                                    {{ Form::open([ 'route' => 'auth.connection:post', ]) }}
                                        {{ Form::hidden('rt3_agent_id', $agent->ID) }}
                                        {{ Form::submit($agent->office->NAME, [ 'class' => 'btn btn-primary', ]) }}
                                    {{ Form::close() }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @else
                <div class="alert alert-danger">
                    <p>
                        Your profile does not have a linked RT3 Person record.
                    </p>

                    <p>
                        Please ensure that your RT3 account uses the same e-mail address: <strong>{{ Auth::user()->email }}</strong>.
                    </p>

                    <p>
                        Alternatively, login with the email account that corresponds to your RT3 login.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
