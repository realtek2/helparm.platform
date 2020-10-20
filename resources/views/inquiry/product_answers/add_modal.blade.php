<div class="modal-header">
    <h2 class="modal-title" id="myModalLabel"><strong>Ваш склад</strong></h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
</div>
<div id="result"></div>

<div class="modal-body no-padding">

    <form action="{{ route('answer.store') }}" method="post" id="products_answer" class="smart-form">
        <input type="hidden" name="name">
        <table class="table warehouse-table">
            <tr>
                <th>№</th>
                <th>Имя</th>
                <th>В наличии</th>
                <th width="168px"></th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td><strong>{{ $product->id }}</strong></td>
                <td class="p-text-color">{{ $product->name }}</td>
                <td><strong>{{ $product->quantity }} шт.</strong></td>
                <td></td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        {{-- <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Изменить</a> --}}
                        <a class="btn btn-secondary px-5" href="{{ route('products.my_warehouse', $product->id) }}">Выбрать</a>
                        @csrf
                        @method('DELETE')
        
                        {{-- <button type="submit" class="btn btn-danger">Удалить</button> --}}
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <footer>
            <button type="submit" class="btn btn-primary">
                Отправить на перемещение
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                Отменить
            </button>
        </footer>
    </form>
</div>
@section('custom_script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.class', function(){
                $.ajax({
                    url: {{ route('products.store') }},
                    methhod: 'POST',
                    data: $('#products_answer').serialize(),
                    success:function(data){
                        $('add_html').html(data)
                    }
                })
            });
        });
    </script>
@endsection