
<h4 class="mb-3"><strong>Ответить на запрос</strong></h4>
<form action="{{ route('answer.store', ['inquiryId' => $inquiry->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Комментарий к ответу</label>
                <textarea class="form-control" name="comment" placeholder="Введите ваше сообщение"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Срок доставки*</label>
                <input type="text" name="delivery_period" class="form-control" required placeholder="Кол-во дней, недель">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Выберите товар со склада:*</label>
                <select class="custom-select" required name="product_id">
                    <option selected disabled>Выберите товар</option>
                    @foreach ($products as $product)
                        @if($product->fund_id == Auth::user()->fund_id )
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endif
                    @endforeach
                  </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Количество шт.*</label>
                <input type="text" name="quantity" class="form-control" required placeholder="Количество">
            </div>
        </div>
        <div class="col-auto mt-2">
            <button type="submit" class="btn btn-olives">Отправить товары</button>
        </div>
        {{-- <div class="col-md-12">
            <a ajax_target="{{ route('answer.form.create') }}" href="javascript:void(0);" class="btn btn-success remote_modal">
                <i class="fa fa-plus"></i> Выбрать товары со склада
            </a>
        </div> --}}
    </div>
</form>