@extends('layouts.app')

@section('content')
    <div class="container">
        @include('warehouse.topbar')
        <div class="row">
            <div class="col-lg-10 mb-2">
                <div class="float-left">
                    <h1><strong>Мой склад</strong></h1>
                </div>
            </div>
            <div class="col">
                <div class="float-right">
                    {{-- <a class="btn unload" href="#"><i class="fas fa-plus mr-2"></i>ВЫГРУЗИТЬ</a> --}}
                    <div class="col-md-12">
                        <a ajax_target="{{ route('products.create') }}" href="javascript:void(0);" class="btn inquiry-index-create-button remote_modal">
                            <i class="fa fa-plus mr-2"></i> ДОБАВИТЬ
                        </a>
                    </div>
                    {{-- <a class="btn inquiry-index-create-button" href="{{ route('products.create') }}"><i class="fas fa-plus mr-2"></i>ДОБАВИТЬ</a> --}}
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($products->count())
        <table class="table warehouse-table">
            <tr>
                <th width="4%">@sortablelink('is_urgent', '+')</th>
                <th width="4%">№</th>
                <th width="24%">Наименование</th>
                <th width="12%">Категория</th>
                <th width="8%">Ед. изм.</th>
                <th width="8%">Остаток</th>
                <th width="8%">Резеерв</th>
                <th width="8%">Свободно</th>
                <th width="4%"></th>
                <th width="4%"></th>
                <th width="4%"></th>
                <th width="8%"></th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td><strong>{{ $product->is_urgent }}</strong></td>
                <td><strong>{{ $product->id }}</strong></td>
                <td class="product-name underlined">{{ $product->name }}</td>
                <td class="p-text-color">{{ $product->medicamentsCategory->name }}</td>
                <td><strong>{{ $product->unit }}.</strong></td>
                <td><strong>{{ $product->quantity }}</strong></td>
                <td><strong>{{ $product->reserve }}</strong></td>
                <td><strong>{{ $product->free }}</strong></td>
                <td class="warehouse-table-icon undefined_object"></td>
                <td class="warehouse-table-icon increase_request"></td>
                <td class="warehouse-table-icon logs"></td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        {{-- <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Изменить</a> --}}
                        <a class="btn btn-secondary px-4 disabled" href="{{ route('products.my_warehouse', $product->id) }}">Переместить</a>
                        @csrf
                        @method('DELETE')
        
                        {{-- <button type="submit" class="btn btn-danger">Удалить</button> --}}
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @else
            <h3>Нет созданных товаров.</h3>
        @endif

        {!! $products->appends(['sort' => 'id'])->links() !!}
        
    </div>
      
@endsection