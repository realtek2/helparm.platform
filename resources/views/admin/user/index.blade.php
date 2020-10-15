@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2>Пользователи</h2>
                </div>
                <div class="pull-right my-4">
                    <a class="btn btn-olives" href="{{ route('admin.users.create') }}">Добавить пользователя</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($users->count())
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Е-майл</th>
                <th>Фонд</th>
                <th width="19%">Action</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->fund->name }}</td>
                <td>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}">Изменить</a>
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <h3>Нет созданных пользователей.</h3>
        @endif

        {!! $users->links() !!}
        
    </div>
      
@endsection