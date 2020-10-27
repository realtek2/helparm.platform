@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Редактирование фонда</h2>
            </div>
            <div class="pull-right my-4">
                <a class="btn btn-primary" href="{{ redirect()->back()->getTargetUrl() }}"> Назад</a>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Заполните указанные ниже поля:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" class="form-control" required value="{{ $product->nomenclature->name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <label>Категория запроса:*</label>
                    <select class="custom-select border border-dark rounded-0" required name="category_id">
                        <option selected disabled>Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option @if($category->id == $product->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Количество:</strong>
                    <input type="text" name="quantity" class="form-control" required value="{{ $product->quantity }}" placeholder="Адрес">
                </div>
            </div>
            <div class="col-auto mt-2">
                <button type="submit" class="btn btn-olives">Редактировать товар</button>
            </div>
            <div class="col-auto mt-2">
                <a class="btn" href="{{ redirect()->back()->getTargetUrl() }}"> Отмена</a>
            </div>
        </div>
    
    </form>
</div>
@endsection