@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="pull-left">
                <h1><strong>Новый запрос</strong><br> создание запроса ещё не готово*</h1>
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
    
    <form action="{{ route('funds.store') }}" method="POST">
        @csrf
    
        <div class="col-md-9 p-0">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Наименование запроса*</label>
                        <input type="text" name="name" class="form-control border border-dark rounded-0" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Примечание</label>
                        <textarea class="form-control border border-dark rounded-0" name="description"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Категория запроса:*</label>
                        <select class="custom-select border border-dark rounded-0" required name="category_id">
                            <option selected>Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Тип запроса:*</label>
                        <select class="custom-select border border-dark rounded-0" required name="category_id">
                            <option selected>Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Укажите необходимое количество*</label>
                        <input type="text" name="email" class="form-control border border-dark rounded-0"">
                    </div>
                </div>
                <div class="col-auto">
                        <button type="submit" class="btn btn-success">Создать запрос</button>
                </div>
                <div class="col-auto">
                    <a class="btn" href="{{ route('funds.index') }}"> Отмена</a>
                </div>
            </div>
        </div>
    
    </form>
</div>
@endsection