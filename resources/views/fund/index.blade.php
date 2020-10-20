@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2>Фонды</h2>
                </div>
                <div class="pull-right my-4">
                    <a class="btn btn-olives" href="{{ route('funds.create') }}">Добавить фонд</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($funds->count())
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Е-майл</th>
                <th width="19%">Action</th>
            </tr>
            @foreach ($funds as $fund)
            <tr>
                <td>{{ $fund->id }}</td>
                <td>{{ $fund->name }}</td>
                <td>{{ $fund->description ?? '-'}}</td>
                <td>{{ $fund->address }}</td>
                <td>{{ $fund->number }}</td>
                <td>{{ $fund->email }}</td>
                <td><a href="{{ route('funds.show', ['fund' => $fund]) }}">Подробнее</a></td>
            </tr>
            @endforeach
        </table>
        @else
        <h3>Нет созданных фондов.</h3>
        @endif

        {!! $funds->links() !!}
        
    </div>
      
@endsection