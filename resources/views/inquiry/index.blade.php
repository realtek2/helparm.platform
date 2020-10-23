@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="float-left">
                    <h1><strong>Запросы</strong></h1>
                </div>
                <div class="float-right">
                    <a class="btn inquiry-index-create-button px-5 py-2" href="{{ route('inquiries.create') }}"><i class="fas fa-plus mr-1"></i> СОЗДАТЬ ЗАПРОС</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-9 pr-4">
                <div class="float-left">
                    <ul class="list-inline">
                        <li class="list-inline-item mr-4">
                            <h4>
                                <a href="{{ route('inquiries.index') }}" 
                                   class="{{ Request::url('inquiries.index') === route('inquiries.index') ? 'font-weight-bold text-dark' : '' }}"
                                   >
                                    Все
                                </a>
                            </h4>
                        </li>
                        <li class="list-inline-item mr-4 p-text-color">
                            <h4>
                                <a href="{{ route('inquiries.new_inquiries') }}"
                                   class="{{ Request::url('inquiries.new_inquiries') === route('inquiries.new_inquiries') ? 'font-weight-bold text-dark' : '' }}"
                                >
                                    Новые запросы
                                </a>
                            </h4>
                        </li>
                        <li class="list-inline-item mr-4 p-text-color">
                            <h4>
                                <a href="{{ route('inquiries.in_process') }}"
                                   class="{{ Request::url('inquiries.in_process') === route('inquiries.in_process') ? 'font-weight-bold text-dark' : '' }}"
                                >
                                    В работе
                                </a>
                            </h4>
                        </li>
                        <li class="list-inline-item mr-4 p-text-color">
                            <h4>
                                <a href="{{ route('inquiries.archived') }}"
                                   class="{{ Request::url('inquiries.archived') === route('inquiries.archived') ? 'font-weight-bold text-dark' : '' }}"
                                >
                                    Архив
                                </a>
                            </h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($inquiries->count())
            <div class="col-md-9 pr-4">
                @foreach ($inquiries as $inquiry)
                <div class="inquiries-block border p-4 mb-4">
                    <div class="row">
                        <div class="col-md-10">
                            <span class="p-text-color">ID-{{ $inquiry->id }} | {{ $inquiry->medicamentsCategory->name }} | {{ $inquiry->createdByFund->city }}</span>
                        </div>
                        <div class="col lead m-n4">
                            @switch($inquiry::STATUSES)
                                @case($inquiry->status === $inquiry::NEW_INQUIRY)
                                    <h3 class="badge-custom new float-right" style="font-weight: 400">Новый</h3>
                                    @break
                                @case($inquiry->status === $inquiry::IN_PROCESS)
                                    <h3 class="badge-custom in_process float-right" style="font-weight: 400">В работе</h3>
                                    @break
                                @case($inquiry->status === $inquiry::ARCHIVED)
                                    <h3 class="badge-custom archived float-right" style="font-weight: 400">Архив</h3>
                                    @break
                                @default
                            @endswitch
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-8"><h3><a class="text-dark" href="{{ route('inquiries.show', ['inquiry' => $inquiry]) }}">{{ $inquiry->name }}</a></h3></div>
                        <div class="col-md-2">
                            <span>Нужно:</span>
                            <p class="mt-n2 number_size">{{ number_format($inquiry->quantity, 0, '.', ' ') }} шт.</p>
                        </div>
                        <div class="col-md-2">
                            <span>Отправлено:</span>
                            <p class="mt-n2 send-text number_size">0 шт.</p>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-10">
                            <span class="mr-2 p-text-color">Создал</span>
                            <span @if(Auth::user()->fund_id == $inquiry->created_by_fund) class="underline" @endif>{{ $inquiry->createdByFund->name }} @if(Auth::user()->fund_id == $inquiry->created_by_fund) (Вы)@endif</span>
                            <span class="mr-2 ml-2 p-text-color">{{ $inquiry->created_at }}</span>
                            <span class="ml-3"><a href="#"> {{ $inquiry->request_to_all == 0 ? $inquiry->fund->name : 'Общий запрос' }}</a></span>
                        </div>
                        <div class="col">
                            <span><strong>Ответов:</strong></span><span class="answers_count">{{ $answers->where('inquiry_id', $inquiry->id)->count() ?? '0' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="col">
                <h3>Нет запросов.</h3>
            </div>
            @endif
        </div>
        {!! $inquiries->links() !!}
    </div>
      
@endsection