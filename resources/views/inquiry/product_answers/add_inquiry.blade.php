
<h4><strong>Ответить на запрос</strong></h4>
<form action="{{ route('asnwer.store', ['inquiryId' => $inquiry->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Комментарий к ответу</strong>
                <textarea class="form-control" name="comment" placeholder="Введите ваше сообщение"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Срок доставки*</label>
                <input type="text" name="delivery_period" class="form-control border border-dark rounded-0" required placeholder="Кол-во дней, недель">
            </div>
        </div>
        <div class="col-md-12">
            <a ajax_target="{{ route('answer.form.create') }}" href="javascript:void(0);" class="btn btn-success remote_modal">
                <i class="fa fa-plus"></i> Выбрать товары со склада
            </a>
        </div>
    </div>
</form>