@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3 mt-2">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2>Ответы на запросы</h2>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($answers->count())
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Запрос</th>
                <th>Фонд</th>
                <th>Статус отправки</th>
                <th>Срок отправления</th>
                <th>Количество</th>
                <th width="100px">Action</th>
            </tr>
            @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->id }}</td>
                <td>{{ $answer->inquiry->name }}</td>
                <td>{{ $answer->fund->name }}</td>
                <td>
                    @switch($answer::STATUSES)
                    @case($answer->delivery_status === $answer::WAITING_FOR_CONFIRMATION_DELIVERY)
                        <p class="badge-custom text-dark" style="font-weight: 400">Ждёт подтверждения</p>
                        @break
                    @case($answer->delivery_status === $answer::DELIVERY_ASNWER_CONFIRMED)
                        <p class="badge-custom text-dark" style="font-weight: 400">Ответ подтверждён</p>
                        @break
                    @case($answer->delivery_status === $answer::DELIVERY_SENT)
                        <p class="badge-custom text-dark" style="font-weight: 400">Продукты отправлены</p>
                        @break
                    @case($answer->delivery_status === $answer::DELIVERED)
                        <p class="badge-custom text-dark" style="font-weight: 400">Доставлены</p>
                        @break
                    @case($answer->delivery_status === $answer::NOT_DELIVERED)
                        <p class="badge-custom text-dark" style="font-weight: 400">Не доставлены</p>
                        @break
                    @default
                @endswitch    
                </td>
                <td>{{ $answer->delivery_period }}</td>
                <td>{{ $answer->quantity }}</td>
                <td>
                    <form action="{{ route('answer.destroy', $answer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <h3>Нет ответов на запросы.</h3>
        @endif

        {!! $answers->links() !!}
        
    </div>
      
@endsection