@auth
    @if (config('appcues.id'))
        <script src="//fast.appcues.com/{{ config('appcues.id') }}.js"></script>

        <script>
            window.Appcues.identify('{{ md5(Auth::user()->email) }}', {
                email: '{{ Auth::user()->email }}',
                created_at: '{{ Auth::user()->created_at->timestamp }}',
                @if (Auth::user()->default_agent)
                    'first_name': '{{ Auth::user()->default_agent->first_name }}',
                    'last_name': '{{ Auth::user()->default_agent->last_name }}',
                @endif
            });

            @if (Auth::user() && Auth::user()->created_at->gt(now()->subMinute()))
                window.Appcues.track("{{ sprintf('%s Account First Created', config('app.name')) }}");
            @endif
        </script>
    @endif
@endauth
