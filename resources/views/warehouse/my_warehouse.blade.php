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
            <div class="col">
                <div class="float-right">
                    {{-- <a class="btn unload" href="#"><i class="fas fa-plus mr-2"></i>ВЫГРУЗИТЬ</a> --}}
                    <div class="col-md-12">
                        <a ajax_target="{{ route('products.create') }}" href="javascript:void(0);" class="btn inquiry-index-create-button remote_modal">
                            <i class="fa fa-plus mr-2"></i> ДОБАВИТЬ
                        </a>
                    </div>
                    {{-- <a class="btn inquiry-index-create-button" href="{{ route('products.create') }}"><i class="fas fa-plus mr-2"></i>ДОБАВИТЬ</a> --}}
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <input type="text" name="email" class="form-control searchEmail" placeholder="Search for Email Only...">
            </div>
        </div>

        @if ($products->count())
        <table class="table warehouse-table" id="warehouse-table">
            <thead>
                <tr>
                    <th width="4%">@sortablelink('is_urgent', '+')</th>
                    <th width="4%">№</th>
                    <th width="24%">Наименование</th>
                    <th width="12%">Категория</th>
                    <th width="8%">Ед. изм.</th>
                    <th width="8%">Остаток</th>
                    <th width="8%">Резеерв</th>
                    <th width="8%">Свободно</th>
                    <th width="4%"></th>
                    <th width="4%"></th>
                    <th width="4%"></th>
                    <th width="8%"></th>
                </tr>
            </thead>
            <tbody></tbody>
            @if(false)
            @foreach ($products as $product)
            <tr>
                <td><strong>{{ $product->is_urgent }}</strong></td>
                <td><strong>{{ $product->id }}</strong></td>
                <td class="product-name underlined">{{ $product->name }}</td>
                <td class="p-text-color">{{ $product->medicamentsCategory->name }}</td>
                <td><strong>{{ $product->unit }}.</strong></td>
                <td><strong>{{ $product->quantity }}</strong></td>
                <td><strong>{{ $product->reserve }}</strong></td>
                <td><strong>{{ $product->free }}</strong></td>
                <td class="warehouse-table-icon undefined_object"></td>
                <td class="warehouse-table-icon increase_request"></td>
                <td class="warehouse-table-icon logs"></td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        {{-- <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Изменить</a> --}}
                        <a class="btn btn-secondary px-4 disabled" href="{{ route('products.my_warehouse', $product->id) }}">Переместить</a>
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

        {!! $products->appends(['sort' => 'id'])->links() !!}
        
    </div>
      
@endsection

@section('custom_script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript">
        $(function () {
         
          var table = $('#warehouse-table').DataTable({
              processing: true,
              serverSide: false,
              ajax: {
                url: "{{ route('products.datatable') }}",
                data: function (d) {
                      d.email = $('.searchEmail').val(),
                      d.search = $('input[type="search"]').val()
                  }
              },
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
         
          $(".searchEmail").keyup(function(){
              table.draw();
          });
        
        });
      </script>

@endsection