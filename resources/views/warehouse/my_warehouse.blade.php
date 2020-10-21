@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endsection
@section('content')
    <div class="container">
        @include('warehouse.topbar')
        <div class="row">
            <div class="col-lg-10 mb-2">
                <div class="float-left">
                    <h1><strong>Мой склад</strong></h1>
                </div>
            </div>
        </div>

            <form id="product-filter">
                <div class="row">
                @include('warehouse.filter')
                    <div class="col">
                        <div class="float-right">
                            {{-- <a class="btn unload" href="#"><i class="fas fa-plus mr-2"></i>ВЫГРУЗИТЬ</a> --}}
                            <div class="col-md-12">
                                <a ajax_target="{{ route('products.create') }}" href="javascript:void(0);" class="btn inquiry-index-create-button remote_modal">
                                    <i class="fa fa-plus mr-2"></i> ДОБАВИТЬ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($products->count())
        <table class="table warehouse-table" id="warehouse-table">
            <thead>
                <tr>
                    {{-- @sortablelink('is_urgent', '+') --}}
                    <th width="1%" style="margin-right: 20px !important"></th>
                    <th width="4%">№</th>
                    <th width="24%">Наименование</th>
                    <th width="12%">Категория</th>
                    <th width="8%">Ед. изм.</th>
                    <th width="8%">Остаток</th>
                    <th width="8%">Резеерв</th>
                    <th width="8%">Свободно</th>
                    <th width="5%"></th>
                    <th width="5%"></th>
                    <th width="5%"></th>
                    <th width="8%"></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        @else
            <h3>Нет созданных товаров.</h3>
        @endif

    </div>
      
@endsection

@section('custom_script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript">
       $(document).ready(function(){
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
            });

            let otable = $('#warehouse-table').DataTable({  
            ajax: {
                url: "{!! route('products.datatable') !!}",
                type: 'POST',
                data: function(d){
                    const dataArray = $('#product-filter').serializeArray();
                    $(dataArray).each(function(i, field){
                        d[field.name] = field.value;   
                    });
                }
            },
            pageLength: 10,
            processing: true,
            serverSide: true,
            bPaginate: true,
            lengthChange: false,
            responsive: true,  
            searching: false,  
            ordering:false,
            info: false,

            columns: [
                {data: 'is_urgent'},
                {data: 'id'},
                {data: 'name', className: 'product-name underlined'},
                {data: 'category_id', className: 'p-text-color'},
                {data: 'unit', className: "font-weight-bold"},
                {data: 'quantity', className: "font-weight-bold"},
                {data: 'reserve', className: "font-weight-bold"},
                {data: 'free', className: "font-weight-bold"},
                {data: 'undefined_object'},
                {data: 'increase_request'},
                {data: 'logs'},
                {data: 'move_button'},

            ],
            columnDefs: [
                { 
                    targets: -1, 
                    orderable: true,
                    render: function ( data, type, full ) {
                    return $("<div/>").html(data).text(); 
                    }
                }
            ],
        });
        $('#warehouse-table ul').addClass("pagination-sm");
        $('#search-products').click(function (e) {
                e.preventDefault();
                if (typeof otable === "object") {
                    otable.ajax.reload();
                }
            if (typeof otable === "undefined") {
                    pagefunction();
                }
            });

             
        $('#reset_search').click(function (e) {
            e.preventDefault();
            $('#product-filter').find("input[type=text], textarea ,select").val("");
            otable.ajax.reload();
        });
    });
      </script>
@endsection