@extends('layouts.app')

@section('content')
    <div class="container mb-5">
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
                    <a class="btn btn-olives px-4 py-2" href="{{ route('inquiries.create') }}">Создать запрос</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-9 pr-4">
                <div class="float-left">
                    <ul class="list-inline">
                        <li class="list-inline-item mr-4"><h4><strong>Все</strong></h4></li>
                        <li class="list-inline-item mr-4 inquiry-text-color"><h4>Активные</h4></li>
                        <li class="list-inline-item mr-4 inquiry-text-color"><h4>В работе</h4></li>
                        <li class="list-inline-item mr-4 inquiry-text-color"><h4>Архив</h4></li>
                    </ul>
                </div>
                <div class="float-right">
                    <ul class="list-inline">
                        <li class="list-inline-item pull-right mr-5"><h5><i class="fas fa-th-list mr-3"></i>Список</h5></li>
                        <li class="list-inline-item pull-right inquiry-text-color"><h5><i class="fas fa-th-large mr-3"></i>Плиткой</h5></li>
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
                            <span class="inquiry-text-color">ID-{{ $inquiry->id }} / {{ $inquiry->medicamentsCategory->name }} / Москва</span>
                        </div>
                        <div class="col lead">
                            <h3 class="badge badge-olives float-right" style="font-weight: 400">В работе</h3>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-8"><h3><strong>{{ $inquiry->name }}</strong></h3></div>
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
                            <span class="mr-2 inquiry-text-color">Дата создания:</span><span>{{ $inquiry->created_at }}</span>
                            <span class="ml-4 inquiry-text-color">Тип запроса:</span><a href="#"> {{ $inquiry->fund->name ?? 'Для всех' }}</a>
                        </div>
                        <div class="col">
                            <span class="float-right">Ответов: 1</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <h3>Нет запросов.</h3>
            @endif
        </div>
        {!! $inquiries->links() !!}
    </div>
      
@endsection