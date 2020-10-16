@forelse ($answers as $answer)
<div class="row border-bottom pb-5 pt-4 mb-5">
    <div class="col-md-1 example-logo"></div>
    <div class="col-md-7 border-right">
        <div class="col">
            <span class="p-text-color">Ваш ответ</span>
        </div>
        <div class="col mt-2 mb-4">
            <h2><strong>{{ $answer->fund->name }}</strong></h2>
        </div>
        @foreach ($productAnswers as $product)
            <div class="col">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" disabled value="{{ $product->product->name }}" class="form-control border border-dark rounded-0"">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" disabled value="{{ $answer->quantity }} шт." class="form-control border border-dark rounded-0"">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col">
            <div class="row">
                <div class="col-md-3">
                    <span class="p-text-color">Срок доставки</span><p>От {{ $answer->delivery_period }} дней</p>
                </div>
                <div class="col-md-3">
                    <span class="p-text-color">Общее кол-во</span><p>{{ $answer->quantity }} шт.</p>
                </div>
                <div class="col-md-6">
                    <span class="p-text-color">Дата отправления</span><p><strong>{{ $answer->delivery_date ?? ' - ' }}</strong></p>
                </div>
            </div>
        </div>
        @if($answer->comment)
            <div class="col bg-grey-comment pt-3 pl-3 pb-1">
                <span class="p-text-color">Комментарий поставщика:</span><p class="mt-2">{{ $answer->comment }}</p>
            </div>
        @endif
    </div>
    <div class="col-md-4 text-center align-self-center">
       <button class="btn btn-olives px-5">Принять</button>
    </div>
</div>
@empty
    <h2>Ответов нет</h2>
@endforelse