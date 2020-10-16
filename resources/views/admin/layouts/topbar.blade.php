<header>
      <nav class="text-white navbar navbar-expand-md navbar-dark bg-info mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-3">
                        <a href="{{ route('admin.funds.index') }}" class="navbar-brand">Запросы</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route('admin.funds.index') }}" class="navbar-brand">Фонды</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.warehouses.index') }}" class="navbar-brand">Склад</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="navbar-brand">Пользователи</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('admin.users.edit', ['user' => Auth::user()]) }}">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>