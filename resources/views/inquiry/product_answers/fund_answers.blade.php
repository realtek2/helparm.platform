@foreach ($fundAnswers as $answer)
    <div class="row border-bottom pb-5 pt-4">
        <div class="col-md-1 example-logo"></div>
        <div class="col-md-9 border-right">
            <div class="col">
                <span class="text-color">Ваш ответ</span>
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
                        <span class="text-color">Срок доставки <p>От {{ $answer->delivery_period }} дней</p></span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-color">Общее кол-во <p>{{ $answer->quantity }} шт.</p></span>
                    </div>
                    <div class="col-md-6">
                        @if($answer->delivery_status === $answer::DELIVERY_ASNWER_CONFIRMED)
                        <form action="">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="delivery_sent_date" class="form-control border border-dark rounded-0"  placeholder="Введите дату отправки">
                            </div>
                        </form>
                        @elseif($answer->delivery_status === $answer::DELIVERY_SENT)
                        <span class="text-color">Дата отправления <p><strong>{{ $answer->delivery_sent_date->format('d-m-Y') }}</strong></p></span>
                        @else
                        <span class="text-color">Дата отправления <p><strong> - </strong></p></span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-3 ml-2">
                <div class="col-md-4">
                    <h5><a href="#" class="edit-button"><i class="fas fa-pen mr-3"></i>Редактировать</a></h5>
                </div>
                <div class="col-md-4 ml-n5 pl-0">
                    <h5>
                        <form action="{{ route('answer.destroy', ['id' => $answer_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button"><i class="fas fa-times mr-3"></i>Удалить ответ</button>
                        </form>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-2 text-center align-self-center" id="sent_delivery_block">
            @if($answer->delivery_status === $answer::DELIVERY_ASNWER_CONFIRMED)
                <a href="{{ route('answer.sent_delivery', ['answerId' => $answer->id]) }}" id="sentDelivery" class="btn answers-button success px-5">Отправить</a>
            @elseif($answer->delivery_status === $answer::DELIVERY_SENT)
                <h5>Отправлено <br><p class="p-text-color">Дата отправления</p>{{ $answer->delivery_sent_date->format('d-m-Y') }}</h5>
            @else
                <h5>Ожидание <br>подтверждения</h5>
            @endif
        </div>
    </div>
@endforeach

@section('custom_script')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
            });
            $('#sentDelivery').on('click', function(e){
                e.preventDefault();
                var delivery_sent_date = $('input[name=delivery_sent_date]').val();
                let _token   = $('meta[name="csrf-token"]').attr('content');
                
                $.ajax({
                    url: "{{ route('answer.sent_delivery', ['answerId' => $answer->id]) }}",
                    type: 'POST',
                    data: {
                        delivery_sent_date: delivery_sent_date,
                        _token: _token},
                    success:function(data){
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection