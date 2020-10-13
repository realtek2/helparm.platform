@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление пользователя</h2>
            </div>
            <div class="pull-right my-4">
                <a class="btn btn-primary" href="{{ route('admin.users.index') }}"> Назад</a>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.users.store') }}" method="POST">
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
                    <strong>Пароль:</strong>
                    <input type="password" name="password" class="form-control" required placeholder="Пароль">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Подтверждение пароля:</strong>
                    <input type="password" name="confirm-password" class="form-control" required placeholder="Подтверждение пароля">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Е-майл:</strong>
                    <input type="text" name="email" class="form-control" required placeholder="Е-майл">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фонд:</strong>
                    <select class="custom-select" required name="fund_id">
                        <option selected>Выберите фонд</option>
                        @foreach ($funds as $fund)
                            <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </div>
    
    </form>
</div>
@endsection