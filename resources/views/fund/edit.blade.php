@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Редактирование фонда</h2>
            </div>
            <div class="pull-right my-4">
                <a class="btn btn-primary" href="{{ route('funds.index') }}"> Назад</a>
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
    
    <form action="{{ route('funds.update', $fund->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" class="form-control" required value="{{ $fund->name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Описание:</strong>
                    <textarea class="form-control" name="description" placeholder="Описание">{{ $fund->description ?? '-' }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Адрес:</strong>
                    <input type="text" name="address" class="form-control" required value="{{ $fund->address }}" placeholder="Адрес">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Телефон:</strong>
                    <input type="text" name="number" class="form-control" required value="{{ $fund->address }}" placeholder="Телефон">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Е-майл:</strong>
                    <input type="text" name="email" class="form-control" required value="{{ $fund->email }}" placeholder="Е-майл">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Редактировать</button>
            </div>
        </div>
    
    </form>
</div>
@endsection