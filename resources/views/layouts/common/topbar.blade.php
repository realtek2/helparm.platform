<body>
    <div class="modal fade" id="remote_modal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- content will be filled here from "ajax/modal-content/model-content-1.html" -->
            </div>
        </div>
    </div>
<header>
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'helparm.platform') }}</a>
      </nav> --}}
      <nav class="text-white navbar navbar-expand-sm navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('inquiries.index') }}" class="navbar-brand">Запросы</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="{{ route('funds.index') }}" class="navbar-brand">Фонды</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="navbar-brand">Склад</a>
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
                        <a class="navbar-brand" href="{{ route('admin.users.edit', ['user' => Auth::user()]) }}">
                            <i class="fas fa-user mr-2"></i> {{ Auth::user()->fund->name }} <span class="ml-2">|</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="navbar-brand" 
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"> Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>