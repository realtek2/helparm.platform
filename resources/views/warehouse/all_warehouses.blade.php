@extends('layouts.app')

@section('content')
    <div class="container">
        @include('warehouse.topbar')
        <div class="row">
            <div class="col-lg-10">
                <div class="float-left">
                    <h1><strong>Запасы фондов</strong></h1>
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
                <th width="3%">@sortablelink('is_urgent', '+')</th>
                <th width="3%">№</th>
                <th width="24%">Наименование</th>
                <th width="12%">Категория</th>
                <th width="20%">Фонд</th>
                <th width="7%">Ед. изм.</th>
                <th width="7%">Остаток</th>
                <th width="7%">Резеерв</th>
                <th width="7%">Свободно</th>
                <th width="6%"></th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td><strong>{{ $product->is_urgent }}</strong></td>
                <td><strong>{{ $product->id }}</strong></td>
                <td class="product-name">{{ $product->name }}</td>
                <td class="p-text-color">{{ $product->medicamentsCategory->name }}</td>
                <td class="pb-0"><strong>{{ $product->fund->name ?? '-'}}</strong><p class="p-text-color mt-n1">{{ $product->fund->address }}</p></td>
                <td><strong>{{ $product->unit }}.</strong></td>
                <td><strong>{{ $product->quantity }}</strong></td>
                <td><strong>{{ $product->reserve }}</strong></td>
                <td><strong>{{ $product->free }}</strong></td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        {{-- <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Изменить</a> --}}
                        <a class="btn btn-secondary px-4 disabled" href="{{ route('products.my_warehouse', $product->id) }}">Запросить</a>
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

        {!! $products->links() !!}
        
    </div>
      
@endsection