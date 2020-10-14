@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center mb-4">
            <div class="col-md-12 mx-auto">
                <div class="card text-center custom-block justify-content-center">
                    <div>
                        <p>ЛЕНТА БЫСТРЫХ НОВОСТЕЙ</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb my-3">
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
                <th>Описание</th>
                <th>Фонд</th>
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
                <td>{{ $inquiry->fund->name ?? 'Всем' }}</td>
                <td>{{ $inquiry->quantity }}</td>
                <td>{{ $inquiry->medicamentsCategory ?? 'Медикаменты' }}</td>
                <td>{{ $inquiry->created_at}}</td>
                <td>
                    <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST">
                        <a class="btn btn-info disabled" href="{{ route('inquiries.show', $inquiry->id) }}">Открыть запрос</a>
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