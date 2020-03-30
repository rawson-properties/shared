@auth
    @if (config('appcues.id'))
        <script src="//fast.appcues.com/{{ config('appcues.id') }}.js"></script>

        <?php $key = Str::of(config('app.name'))->after('Rawson ')->slug('_'); ?>
        <script>
            window.Appcues.identify('{{ md5(Auth::user()->email) }}', {
                email: '{{ Auth::user()->email }}',
                @if (Auth::user()->default_agent)
                    first_name: '{{ Auth::user()->default_agent->first_name }}',
                    last_name: '{{ Auth::user()->default_agent->last_name }}',
                @endif
                {{ $key }}_account_created_at: {{ Auth::user()->created_at->timestamp }},
                {{ $key }}_account_age_days: {{ Auth::user()->created_at->diffInDays(now()) }},
            });
        </script>
    @endif
@endauth
