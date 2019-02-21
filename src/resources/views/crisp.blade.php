@if (config('crisp.id'))
    <script type="text/javascript">
        window.$crisp=[];window.CRISP_WEBSITE_ID="{{ config('crisp.id') }}";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();

        @auth
            $crisp.push([ 'set', 'user:email', '{{ Auth::user()->email }}', ]);

            @if (Auth::user()->has_crisp_data)
                @if (Auth::user()->crisp_nickname)
                    $crisp.push([ 'set', 'user:nickname', '{{ Auth::user()->crisp_nickname }}', ]);
                @endif

                @if (Auth::user()->crisp_phone)
                    $crisp.push([ 'set', 'user:phone', '{{ Auth::user()->crisp_phone }}', ]);
                @endif

                @if (Auth::user()->crisp_avatar)
                    $crisp.push([ 'set', 'user:avatar', '{{ Auth::user()->crisp_avatar }}', ]);
                @endif

                @if (Auth::user()->has_crisp_office_data)
                    $crisp.push([
                        'set', 'user:company', [ '{{ Auth::user()->crisp_company }}', {
                            employment: [
                                '{{ Auth::user()->crisp_job_title }}',
                                '{{ Auth::user()->crisp_job_role }}'
                            ],
                        }]
                    ]);
                @endif
            @endif
        @endauth
    </script>
@endif
