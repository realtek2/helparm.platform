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
        <div class="col-md-12">
            <h1><strong>{{ $inquiry->name }}</strong></h1>
        </div>
        <div class="col-md-12">
            <i class="far fa-calendar"></i> <span>{{ $inquiry->created_at }} | </span><span>{{ $inquiry->fund->name ?? 'Общий запрос' }}</span>
        </div>
        <div class="col-md-12">
            <p class="p-text-color">{{ $inquiry->description }}</p>
        </div>
        <div class="col-md-12">
            <span><strong>Ответов:</strong></span><span class="badge badge-warning">0</span>
        </div>
        <hr class="col-md-12">
    </div>
    @if ($inquiry->fund_id == Auth::user()->fund_id)
        @include('inquiry.list_inquiries', ['inquiry' => $inquiry, 'funds' => $funds])
    @else
        @include('inquiry.add_inquiry')
    @endif
</div>
@endsection