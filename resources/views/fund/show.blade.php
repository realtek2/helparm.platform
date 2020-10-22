@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-1 mb-4">
            <h4><a href="{{ route('funds.index') }}">Вернуться в список</a></h4>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-2">
            <div class="maybe-logo"></div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h1><strong>{{ $fund->name }}</strong></h1>
                    <p class="p-text-color mt-n2">{{ $fund->country }} / {{ $fund->city }}</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p class="p-text-color">Телефон:</p>
                    <h5 class="mt-n2"><strong>{{ $fund->number }}</strong></h5>
                </div>
                <div class="col-md-10 mt-1">
                    <p class="p-text-color">E-mail:</p>
                    <h5 class="mt-n2"><a href="mailto:{{ $fund->email }}">{{ $fund->email }}</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection