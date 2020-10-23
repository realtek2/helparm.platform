@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="float-left">
                    <h1><strong>Запросы</strong></h1>
                </div>
                <div class="float-right">
                    <a class="btn btn-olives" href="{{ route('inquiries.create') }}">Создать запрос</a>
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
                <th>Фонд</th>
                <th>Количество</th>
                <th>Категория</th>
                <th>Дата создания</th>
                <th width="338px"></th>
            </tr>
            @foreach ($inquiries as $inquiry)
            <tr>
                <td>ID-{{ $inquiry->id }}</td>
                <td>{{ $inquiry->name }}</td>
                <td>{{ $inquiry->fund->name ?? 'Всем' }}</td>
                <td>{{ $inquiry->quantity }}</td>
                <td>{{ $inquiry->medicamentsCategory->name ?? 'Медикаменты' }}</td>
                <td>{{ $inquiry->created_at}}</td>
                <td>
                    <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('inquiries.show', $inquiry->id) }}">Открыть запрос</a>
                        <a class="btn btn-primary" href="{{ route('inquiries.edit', $inquiry->id) }}">Изменить</a>
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-danger">Удалить</button>
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