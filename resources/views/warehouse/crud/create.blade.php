@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>Добавление товара</h2>
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
    
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
    
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" class="form-control" required placeholder="Имя">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Категория запроса:*</label>
                    <select class="custom-select" required name="category_id">
                        <option selected disabled>Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Количество:</strong>
                    <input type="text" name="quantity" class="form-control" placeholder="Количество">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Ед. изм:</label>
                    <input type="text" name="unit" class="form-control" required placeholder="Ед. изм">
                </div>
            </div>
            <div class="col-auto mt-2">
                <button type="submit" class="btn btn-olives">Создать товар</button>
            </div>
            <div class="col-auto mt-2">
                <a class="btn" href="{{ redirect()->back()->getTargetUrl() }}"> Отмена</a>
            </div>
        </div>
    </form>
</div>
@endsection