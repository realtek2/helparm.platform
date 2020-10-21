<div class="modal-header p-4">
    <h2 class="modal-title" id="myModalLabel"><strong>Увеличение кол-ва</strong></h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
</div>
<div id="result"></div>

<div class="modal-body p-4">
    <form action="{{ route('products.storeQuantity', ['productId' => $product->id]) }}" method="post" id="change_product" class="smart-form">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Изменения кол-ва:</label>
                    <input type="text" name="quantity" value="{{ $product->quantity }}" class="form-control" required>
                </div>
            </div>
        </div>
        <footer class="text-center">
            <button type="button" class="btn btn-default m-4" data-dismiss="modal">
                Отменить
            </button>
            <button type="submit" class="btn btn-primary m-4 px-3 py-2">
                Изменить
            </button>
        </footer>
    </form>
</div>
@section('custom_script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.class', function(){
                $.ajax({
                    url: {{ route('products.storeQuantity', ['productId' => $product->id]) }},
                    methhod: 'POST',
                    data: $('#change_product').serialize(),
                    success:function(data){
                        otable.reload();
                    }
                })
            });
        });
    </script>
@endsection