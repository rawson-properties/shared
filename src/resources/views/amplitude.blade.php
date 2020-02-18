@auth
    @if (config('amplitude.key'))
        <script>
            amplitude.getInstance().init("{{ config('amplitude.key') }}", '{{ md5(Auth::user()->email) }}');
            amplitude.getInstance().setUserProperties({
                Email: '{{ Auth::user()->email }}',
                Name: '{{ Auth::user()->name }}',
            });

            @if (Auth::user()->default_office)
                amplitude.getInstance().setUserProperties({ Office: '{{ Auth::user()->default_office->NAME }}' });
            @endif

            @if (data_get(Auth::user(), 'default_agent.job_title'))
                amplitude.getInstance().setUserProperties({ 'Job Title': '{{ Auth::user()->default_agent->job_title }}' });
            @endif
        </script>
    @endif
@endauth
