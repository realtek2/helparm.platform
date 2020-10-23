@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h4><a href="{{ route('inquiries.index') }}">Вернуться в список</a></h4>
        </div>
        <div class="col-md-12 mb-1">
            <span class="p-text-color">ID-{{ $inquiry->id }} | {{ $inquiry->medicamentsCategory->name }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 pl-0 pr-5">
            <div class="col-md-12">
                <h1><strong>{{ $inquiry->name }}</strong></h1>
            </div>
            <div class="col-md-12 my-3">
                <i class="far fa-calendar"></i> <span>{{ $inquiry->created_at }} | </span><span>{{ $inquiry->fund->name ?? 'Общий запрос' }}</span>
            </div>
            <div class="col-md-12">
                <p class="p-text-color">{{ $inquiry->description }}</p>
            </div>
            <div class="col-md-12">
                <span><strong>Ответов:</strong></span><span class="badge badge-warning">{{ $answers->count() ?? '0' }}</span>
            </div>
            <hr class="col-md-12">
        @if ($inquiry->fund_id == Auth::user()->fund_id)
            @include('inquiry.product_answers.list_answers')
        @else
            @if(isset($answer_fund_id) && $answer_fund_id == Auth::user()->fund_id)
                @include('inquiry.product_answers.fund_answers')
            @else
                @include('inquiry.product_answers.add_inquiry')
            @endif
        @endif
        </div>

        <div class="col-md-3">
            <div class="status-inquiry-block px-3 py-4">
                <div class="col-md-12 mb-4 mt-2">
                    @switch($inquiry::STATUSES)
                        @case($inquiry->status === $inquiry::NEW_INQUIRY)
                            <span class="badge-show new">Новый</span>
                            @break
                        @case($inquiry->status === $inquiry::IN_PROCESS)
                            <span class="badge-show in_process">В работе</span>
                            @break
                        @case($inquiry->status === $inquiry::ARCHIVED)
                            <span class="badge-show archived">Архив</span>
                            @break
                        @default
                    @endswitch
                </div>
                <div class="col-md-12 mb-2">
                    <h3 class="mb-0"><strong>{{ number_format($inquiry->quantity, 0, '.', ' ') }} шт.</strong></h3>
                    <p>Цель:</p>
                </div>
                <div class="col-md-12 mb-2">
                    <h3 class="mb-0"><strong>{{ $countSendedProducts->total ?? '0' }} шт.</strong></h3>
                    <p>Отправлено:</p>
                </div>
                <div class="col-md-12 mb-4">
                    <h3 class="mb-0"><strong>{{ $countDeliveredProducts->total ?? '0' }} шт.</strong></h3>
                    <p>Доставлено:</p>
                </div>
                <div class="col-md-12 mt-5 mb-3">
                    <button class="status-inquiry-block-button mt-3">ЗАКРЫТЬ ЗАПРОС</button>
                </div>
            </div>
            @if(Auth::user()->fund_id == $inquiry->fund_id)
            <div class="row p-4">
                <div class="col-md-12 ml-2 mt-3">
                    <h5><i class="fas fa-pen mr-3"></i><a class="edit-button" href="{{ route('inquiries.edit', ['inquiry' => $inquiry]) }}">Редактировать</a></h5>
                </div>
                <div class="col-md-12 ml-2 mt-3">
                    <h5>
                        <form action="{{ route('inquiries.destroy', ['inquiry' => $inquiry->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <i class="fas fa-times mr-3" style="color:#BDBDBD"></i><button class="delete-button" type="submit">Отменить запрос</button>
                        </form>
                    </h5>
                </div>
            </div>
            @endif
        </div>

    </div>

</div>
@endsection