@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Запросы</h2>
                </div>
                <div class="pull-right my-4">
                    <a class="btn btn-success" href="{{ route('inquiries.create') }}">Добавить запрос</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($inquiries->count())
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Тип запроса</th>
                <th>Количество</th>
                <th>Категория</th>
                <th>Дата создания</th>
                <th>Action</th>
            </tr>
            @foreach ($inquiries as $inquiry)
            <tr>
                <td>ID-{{ $inquiry->id }}</td>
                <td>{{ $inquiry->name }}</td>
                <td>{{ $inquiry->description ?? ''}}</td>
                <td>{{ $inquiry->fund->name }}</td>
                <td>{{ $inquiry->quantity }}</td>
                <td>{{ $inquiry->medicamentsCategory ?? 'Медикаменты' }}</td>
                <td>{{ $inquiry->created_at}}</td>
                <td>
                    <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST">
                        <a class="btn btn-info disabled" href="{{ route('inquiries.show', $inquiry->id) }}">Открыть запрос</a>
                        <a class="btn btn-primary disabled" href="{{ route('inquiries.edit', $inquiry->id) }}">Изменить</a>
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-danger disabled">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <h3>Нет запросов.</h3>
        @endif

        {!! $inquiries->links() !!}
        
    </div>
      
@endsection