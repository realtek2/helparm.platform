<header>
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'helparm.platform') }}</a>
      </nav> --}}
      <nav class="text-white navbar navbar-expand-sm navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a href="#" class="navbar-brand">Запросы</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('funds.index') }}" class="navbar-brand">Фонды</a>
                </li>
            </ul>
            @endauth
            <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="navbar-brand" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="ml-2">|</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Выйти
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            @endguest
            </ul>
        </div>
    </nav>
</header>