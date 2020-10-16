@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-2">
            <div class="col-lg-10">
                <div class="float-left">
                    <h1><strong>Склад</strong></h1>
                </div>
            </div>
            <div class="col">
                <div class="float-right">
                    <a class="btn btn-olives" href="{{ route('products.create') }}"><i class="fas fa-plus mr-2"></i>Добавить товар</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($products->count())
            @include('warehouse.table', ['products' => $products])
        @else
            <h3>Нет созданных товаров.</h3>
        @endif

        {!! $products->links() !!}
        
    </div>
      
@endsection