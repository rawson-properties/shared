@if (config('crisp.id'))
    <script type="text/javascript">
        window.$crisp=[];window.CRISP_WEBSITE_ID="{{ config('crisp.id') }}";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();

        @auth
            $crisp.push([ 'set', 'user:email', '{{ Auth::user()->email }}', ]);

            @if (Auth::user()->default_agent)
                @if (Auth::user()->default_agent->name)
                    $crisp.push([ 'set', 'user:nickname', '{{ Auth::user()->default_agent->name }}', ]);
                @endif

                @if (Auth::user()->default_agent->cellphone)
                    $crisp.push([ 'set', 'user:phone', '{{ Auth::user()->default_agent->cellphone }}', ]);
                @endif

                @if (Auth::user()->default_agent->photo_url_small)
                    $crisp.push([ 'set', 'user:avatar', '{{ Auth::user()->default_agent->photo_url_small }}', ]);
                @endif
            @endif
        @endauth
    </script>
@endif
