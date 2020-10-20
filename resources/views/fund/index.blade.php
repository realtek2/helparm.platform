@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-4">
                <div class="float-left">
                    <h1><strong>Фонды</strong></h1>
                </div>
                @if(Auth::user()->is_admin == 2)
                <div class="float-right">
                    <a class="btn inquiry-index-create-button" href="{{ route('funds.create') }}">Добавить фонд</a>
                </div>
                @endif
            </div>
        </div>
        <div class="row border-bottom-funds mr-n5 mb-4">
            <div class="col-md-12">
                <div class="float-left">
                    <ul class="list-inline">
                        <li class="list-inline-item mr-4"><h6><strong>Все</strong></h6></li>
                        <li class="list-inline-item mr-4 p-text-color"><h6>Есть обновления</h6></li>
                    </ul>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
        @if ($funds->count())
            @foreach ($funds as $fund)
                <div class="row">
                    <div class="col-md-1">
                        <div class="fund-index-logo"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <h3><strong>{{ $fund->name }}</strong></h3>
                            <p class="p-text-color">{{ $fund->address }}</p>
                        </div>
                        <div class="col-md-12">
                            <a href="mailto:{{ $fund->email }}">{{ $fund->email }}</a>
                            <p><strong>{{ $fund->number }}</strong></p>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <h3>{{ $fund->answers->count() }}</h3>
                        <p class="p-text-color mt-n2">Отвтов на запросы</p>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <h3>{{ number_format(300000, 0, '.', ' ') }} Р</h3>
                        <p class="p-text-color">Собрано финансов</p>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="rounded-icon medicament"></div>
                            <p class="p-text-color">
                                {{ \App\Models\Product::where('fund_id', $fund->id)->where('category_id', \App\Models\Product::MEDICAMENTS)->selectRaw('sum(quantity) as quantity_sum')->first()->quantity_sum ?? '0' }} шт.
                            </p>
                            </div>
                            <div class="col-md-4">
                                <div class="rounded-icon food"></div>
                            <p class="p-text-color">
                                {{ \App\Models\Product::where('fund_id', $fund->id)->where('category_id', \App\Models\Product::FOOD)->selectRaw('sum(quantity) as quantity_sum')->first()->quantity_sum ?? '0' }} шт.
                            </p>
                            </div>
                            <div class="col-md-4">
                                <div class="rounded-icon financial_aid"></div>
                            <p class="p-text-color">
                                {{ \App\Models\Product::where('fund_id', $fund->id)->where('category_id', \App\Models\Product::FINANCIAL_AID)->selectRaw('sum(quantity) as quantity_sum')->first()->quantity_sum ?? '0' }} шт.
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 pl-5 align-self-center">
                        <a class="fund-show-button" href="{{ route('funds.show', ['fund' => $fund]) }}">Подробнее</a>
                    </div>
                    <hr class="col-md-12">
                </div>
            @endforeach
        @else
        <h3>Нет созданных фондов.</h3>
        @endif

        {!! $funds->links() !!}
        
    </div>
      
@endsection