@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование пользователя</h2>
            </div>
            <div class="pull-right my-4">
                <a class="btn btn-primary" href="{{ route('admin.users.index') }}"> Назад</a>
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
    
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required placeholder="Имя">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Пароль:</strong>
                    <input type="password" name="password" class="form-control" value="{{ $user->password }}" required placeholder="Пароль">
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
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}" required placeholder="Е-майл">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фонд:</strong>
                    <select class="custom-select" name="fund_id" required>
                        <option selected>Выберите фонд</option>
                        @foreach ($funds as $fund)
                            <option @if($fund->id == $user->fund_id) selected @endif value="{{ $fund->id }}">{{ $fund->name }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            </div>
        </div>
    
    </form>
</div>
@endsection