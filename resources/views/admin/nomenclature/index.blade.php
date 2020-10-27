@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-2">
            <div class="col-lg-10">
                <div class="float-left">
                    <h1><strong>Номенклатура</strong></h1>
                </div>
            </div>
            <div class="col">
                <div class="float-right">
                    <a class="btn btn-olives" href="{{ route('admin.nomenclatures.create') }}"><i class="fas fa-plus mr-2"></i>Добавить номенклатуру</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($nomenclatures->count())
        <table class="table warehouse-table">
            <tr>
                <th>№</th>
                <th>Имя</th>
                <th width="200px"></th>
            </tr>
            @foreach ($nomenclatures as $nomenclature)
            <tr>
                <td><strong>{{ $nomenclature->id }}</strong></td>
                <td class="p-text-color">{{ $nomenclature->name }}</td>
                <td>
                    <form action="{{ route('admin.nomenclatures.destroy', $nomenclature->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('admin.nomenclatures.edit', $nomenclature->id) }}">Изменить</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @else
            <h3>Нет созданных номенклатур.</h3>
        @endif

        {!! $nomenclatures->appends(['sort' => 'id'])->links() !!}
        
    </div>
      
@endsection