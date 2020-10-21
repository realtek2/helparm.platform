@forelse ($answers as $answer)
<div class="row border-bottom pl-4 pb-5 pt-4 mb-5">
    <div class="col-md-1 example-logo"></div>
    <div class="col-md-8 pr-4 border-right">
        <div class="col">
            <span class="p-text-color">Представительство - {{ $answer->fund->address }}</span>
        </div>
        <div class="col mt-2 mb-4">
            <h2><strong>{{ $answer->fund->name }}</strong></h2>
        </div>
        @foreach ($productAnswers as $product)
            <div class="col">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" disabled value="{{ $product->product->name }}" class="form-control border border-dark rounded-0">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" disabled value="{{ $answer->quantity }} шт." class="form-control border border-dark rounded-0">
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

    <div class="col-md-3 text-center align-self-center statusBlock-{{ $answer->id }}">
        <a id="accept-{{ $answer->id }}" class="btn answers-button success px-5" href="{{ route('answer.accept_answer', ['id' => $answer->id]) }}">Принять</a>
    </div>
    
    <div style="display: none" class="col-md-2 ml-3 text-center align-self-center deliveryBlock-{{ $answer->id }}">
        <span>
            <a id="delivered" class="btn answers-button success px-5 disabled" href="#">Доставлен</a>
        </span>
        <span>
            <a id="undelivered" class="btn answers-button abandon px-5 disabled" href="#">Не доставлен</a>
        </span>
    </div>
   
    {{-- <div style="display: none" class="col-md-4 text-center align-self-center deliveredBlock">
        <a id="accept" class="btn btn-olives px-5" href="{{ route('answer.accept_answer', ['id' => $answer->id]) }}">Доставлен</a>
        <a id="reject" class="btn btn-secondary px-5" href="{{ route('answer.accept_answer', ['id' => $answer->id]) }}">Не доставлен</a>
    </div> --}}
    
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
@if($answer->delivery_status === App\Models\Answer::DELIVERY_ASNWER_CONFIRMED)
    <script>
        $(window).on('load', function(){
            $('.deliveryBlock-{{ $answer->id }}').css('display', 'block');
            $('.statusBlock-{{ $answer->id }}').hide();
        });
    </script>
@elseif($answer->delivery_status === App\Models\Answer::DELIVERED)
    <script>
        $(window).on('load', function(){
            $('.deliveredBlock-{{ $answer->id }}').css('display', 'inherit');
        });
    </script>
@endif
@if($answer->delivery_status === App\Models\Answer::WAITING_FOR_CONFIRMATION_DELIVERY)
    <script>
        $(document).ready(function(){
            $('#accept-{{ $answer->id }}').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('answer.accept_answer', ['id' => $answer->id]) }}",
                    type: 'GET',
                    dataType: 'JSON',
                    success:function(){
                        $('.statusBlock-{{ $answer->id }}').hide();
                        $('.deliveryBlock-{{ $answer->id }}').show();
                    }
                });
            });
        });
    </script>
@endif
@empty
    <h2>Ответов нет</h2>
@endforelse