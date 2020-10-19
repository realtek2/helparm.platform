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
                        <span class="text-color">Срок доставки <p>От {{ $answer->delivery_period }} дней</p></span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-color">Общее кол-во <p>{{ $answer->quantity }} шт.</p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-color">Дата отправления <p><strong>{{ $answer->delivery_date ?? ' - ' }}</strong></p></span>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <h5><a href="#"><i class="fas fa-pen mr-3"></i>Редактировать</a></h5>
                </div>
                <div class="col-md-4">
                    <h5>
                        <form action="{{ route('answer.destroy', ['id' => $answer_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="#"><i class="fas fa-times mr-3"></i>Удалить ответ</a>
                        </form>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-2 text-center align-self-center">
            <h5>Ожидание <br>подтверждения</h5>
        </div>
    </div>
@endforeach