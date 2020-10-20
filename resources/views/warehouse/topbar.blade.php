<div class="row mt-4 mb-2">
    <div class="col-md-9 mt-2 pr-4">
        <div class="float-left">
            <ul class="list-inline">
                <li class="list-inline-item topbar-li mr-4">
                    <p>
                        <a class="{{ Request::path('my_warehouse') === 'my_warehouse' ? 'font-weight-bold text-dark' : '' }}" href="{{ route('products.my_warehouse') }}">
                            Мой склад
                        </a>
                    </p>
                </li>
                <li class="list-inline-item topbar-li mr-4">
                    <p>
                        <a class="{{ Request::path('all_warehouses') === 'all_warehouses' ? 'font-weight-bold text-dark' : '' }}" href="{{ route('products.all_warehouses') }}">
                            Запасы фондов
                        </a>
                    </p>
                </li>
                <li class="list-inline-item topbar-li mr-4 p-text-color"><p>Запросы на перемещение</p></li>
                <li class="list-inline-item topbar-li mr-4 p-text-color"><p>Категории товаров</p></li>
            </ul>
        </div>
    </div>
</div>