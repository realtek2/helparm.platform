@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endsection
@section('content')
    <div class="container">
        @include('warehouse.topbar')
        <div class="row">
            <div class="col-lg-10">
                <div class="float-left">
                    <h1><strong>Запасы фондов</strong></h1>
                </div>
            </div>
        </div>

        <form id="product-filter">
            <div class="row">
            @include('warehouse.filter')
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
                    <th width="5%"></th>
                    <th width="3%">№</th>
                    <th width="24%">Наименование</th>
                    <th width="12%">Категория</th>
                    <th width="20%">Фонд</th>
                    <th width="7%">Ед. изм.</th>
                    <th width="7%">Остаток</th>
                    <th width="7%">Резеерв</th>
                    <th width="7%">Свободно</th>
                    <th width="6%"></th>
                </tr>
            </thead>
            <tbody></tbody>
            @if(false)
            @foreach ($products as $product)
            <tr>
                <td><strong>{{ $product->is_urgent }}</strong></td>
                <td><strong>{{ $product->id }}</strong></td>
                <td class="product-name">{{ $product->name }}</td>
                <td class="p-text-color">{{ $product->medicamentsCategory->name }}</td>
                <td class="pb-0"><strong>{{ $product->fund->name ?? '-'}}</strong><p class="p-text-color mt-n1">{{ $product->fund->country }} | {{ $product->fund->city }}</p></td>
                <td><strong>{{ $product->unit }}.</strong></td>
                <td><strong>{{ $product->quantity }}</strong></td>
                <td><strong>{{ $product->reserve }}</strong></td>
                <td><strong>{{ $product->free }}</strong></td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        {{-- <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Изменить</a> --}}
                        <a class="btn btn-secondary px-4 disabled" href="{{ route('products.my_warehouse', $product->id) }}">Запросить</a>
                        @csrf
                        @method('DELETE')
        
                        {{-- <button type="submit" class="btn btn-danger">Удалить</button> --}}
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
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
                url: "{!! route('products.all_warehouses.datatable') !!}",
                type: 'POST',
                data: function(d){
                    const dataArray = $('#product-filter').serializeArray();
                    $(dataArray).each(function(i, field){
                        d[field.name] = field.value;   
                    });
                }
            },
            pageLength: 10,
            processing: false,
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
                {data: 'fund_id'},
                {data: 'unit', className: "font-weight-bold"},
                {data: 'quantity', className: "font-weight-bold"},
                {data: 'reserve', className: "font-weight-bold"},
                {data: 'free', className: "font-weight-bold"},
                {data: 'request_product'},
            ],
            columnDefs: [
                { 
                    targets: -1, 
                    orderable: true,
                    render: function ( data, type, full ) {
                    return $("<div/>").html(data).text(); 
                    }
                },
                { className: 'text-align-center', targets: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
            ],
            language: {
                emptyTable: "Таких товаров нет на складах.",
                paginate: {
                    next: "&#5171;",
                    previous: "&#5176;"
                }
            }
        });
        
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