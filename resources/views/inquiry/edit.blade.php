@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="pull-left">
                <h1><strong>Редактировать запрос ID-{{ $inquiry->id }}</strong></h1>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Заполните указанные ниже поля:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('inquiries.update', $inquiry->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="col-md-9 p-0">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Наименование запроса*</label>
                        <input type="text" name="name" class="form-control border border-dark rounded-0" value="{{ $inquiry->name }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Примечание</label>
                        <textarea class="form-control border border-dark rounded-0" name="description">{{ $inquiry->description }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Категория запроса:*</label>
                        <select class="custom-select border border-dark rounded-0" required name="category_id">
                            <option selected disabled>Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option @if($category->id == $inquiry->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Тип запроса:*</label>
                        <br>
                        <div class="custom-control custom-radio custom-control-inline">
                           <input type="radio" 
                                  value="1" 
                                  id="requestToAll" 
                                  name="request_to_all" 
                                  @if(isset($inquiry->request_to_all) && $inquiry->request_to_all == 1) checked @endif
                                  class="custom-control-input">
                           <label class="custom-control-label" for="requestToAll">Для всех</label>
                         </div>
                         <div class="custom-control custom-radio custom-control-inline">
                           <input type="radio" 
                                  value="0" 
                                  id="requestToAll2" 
                                  name="request_to_all" 
                                  @if(isset($inquiry->request_to_all) && $inquiry->request_to_all == 0) checked @endif
                                  class="custom-control-input">
                           <label class="custom-control-label" for="requestToAll2">Личный запрос</label>
                         </div>
                        <select class="custom-select border border-dark rounded-0 mt-3" @if($inquiry->request_to_all == 1) style="display: none" @endif name="fund_id">
                            <option selected disabled>Выберите фонд</option>
                            @foreach ($funds as $fund)
                                <option @if($fund->id == $inquiry->fund_id) selected @endif value="{{ $fund->id }}">{{ $fund->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Укажите необходимое количество*</label>
                        <input type="text" name="quantity" value="{{ $inquiry->quantity }}" class="form-control border border-dark rounded-0"">
                    </div>
                </div>
                <div class="col-auto">
                        <button type="submit" class="btn btn-success">Редактировать запрос</button>
                </div>
                <div class="col-auto">
                    <a class="btn" href="{{ route('inquiries.index') }}"> Отмена</a>
                </div>
            </div>
        </div>
    
    </form>
</div>
@endsection
@section('custom_script')
<script>
    $(document).ready(function () {
        $('input[type=radio][name=request_to_all]').change(function () {
            if (this.id == 'requestToAll2') {
                $('select[name=fund_id]').show();
            }
            else if (this.id == 'requestToAll') {
                $('select[name=fund_id]').hide();
                $('select[name=fund_id]').val('');
            }
        });
    });
</script>
@endsection