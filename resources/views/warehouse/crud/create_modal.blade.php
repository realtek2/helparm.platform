<div class="modal-header p-4">
    <h2 class="modal-title" id="myModalLabel"><strong>Новая позиция</strong></h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
</div>
<div id="result"></div>

<div class="modal-body p-4">

    <form action="{{ route('products.store') }}" method="post" id="add_products" class="smart-form">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <select class="custom-select" required name="name_id">
                        <option selected disabled>Выберите категорию</option>
                        @foreach ($nomenclatures as $nomenclature)
                            <option value="{{ $nomenclature->id }}">{{ $nomenclature->name }}</option>
                        @endforeach
                      </select>
                </div>
                {{-- <div class="form-group">
                    <label for="single-default">Наименование</label>
                    <select multiple="multiple" class="select2 custom-select" name="nomenclatures[][name]" id="single-default">
                        @foreach ($nomenclatures as $nomenclature)
                        <option value="{{ $nomenclature->id }}">{{ $nomenclature->name }}</option>
                    @endforeach
                    </select>
                </div> --}}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Категория</label>
                    <select class="custom-select" required name="category_id">
                        <option selected disabled>Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Количество:</label>
                    <input type="text" name="quantity" onkeyup="this.value=this.value.replace(/[^\d]/,'')" class="form-control" required placeholder="Количество">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Ед. изм:</label>
                    <input type="text" name="unit" class="form-control" required placeholder="Ед. изм">
                </div>
            </div>
        </div>
        <footer class="text-center">
            <button type="button" class="btn btn-default m-4" data-dismiss="modal">
                Отменить
            </button>
            <button type="submit" class="btn btn-primary m-4 px-3 py-2">
                Создать
            </button>
        </footer>
    </form>
</div>
@section('custom_script')
    <script>
        $(document).ready(function(){
            $('.select2').select2(
                {
                    tags: true,
                    multiple: true,
                    tokenSeparators: [','],
                    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
                }
            );
            $(document).on('click', '.class', function(){
                $.ajax({
                    url: {{ route('products.store') }},
                    methhod: 'POST',
                    data: $('#add_products').serialize(),
                    success:function(data){
                        location.reload();
                    }
                })
            });
        });
    </script>
@endsection