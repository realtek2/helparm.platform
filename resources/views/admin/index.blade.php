@extends('admin.layouts.app')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-12 py-1 m-3 px-4 border">
            <h1><a href="{{ route('admin.inquiries.index') }}" class="navbar-brand">Запросы</a></h1>
        </div>
        <div class="col-md-12 py-1 m-3 px-4 border">
            <h1><a href="{{ route('admin.funds.index') }}" class="navbar-brand">Фонды</a></h1>
        </div>
        <div class="col-md-12 py-1 m-3 px-4 border">
            <h1><a href="{{ route('admin.nomenclatures.index') }}" class="navbar-brand">Номенклатура</a></h1>
        </div>
        <div class="col-md-12 py-1 m-3 px-4 border">
            <h1><a href="{{ route('admin.warehouses.index') }}" class="navbar-brand">Склад</a></h1>
        </div>
        <div class="col-md-12 py-1 m-3 px-4 border">
            <h1><a href="{{ route('admin.users.index') }}" class="navbar-brand">Пользователи</a></h1>
        </div>
        <div class="col-md-12 py-1 m-3 px-4 border">
            <h1><a href="{{ route('admin.answers.index') }}" class="navbar-brand">Ответы на запросы</a></h1>
        </div>
    </div>
</div>
@endsection