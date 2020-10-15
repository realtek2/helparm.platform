@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="pull-left">
                <h1><strong>Новый запрос</strong></h1>
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
    <div class="row">
        <div class="col-xs-12 col-md-9 pl-3 pr-5">
        <form action="{{ route('inquiries.store') }}" method="POST">
            @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Наименование запроса*</label>
                            <input type="text" name="name" class="form-control border border-dark rounded-0" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Примечание</label>
                            <textarea class="form-control border border-dark rounded-0" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Категория запроса:*</label>
                            <select class="custom-select border border-dark rounded-0" required name="category_id">
                                <option selected>Выберите категорию</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                      
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Тип запроса:*</label>
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                               <input type="radio" value="1" id="requestToAll" name="request_to_all" class="custom-control-input">
                               <label class="custom-control-label" for="requestToAll">Для всех</label>
                             </div>
                             <div class="custom-control custom-radio custom-control-inline">
                               <input type="radio" value="0" id="requestToAll2" name="request_to_all" class="custom-control-input">
                               <label class="custom-control-label" for="requestToAll2">Личный запрос</label>
                             </div>
                            <select class="custom-select border border-dark rounded-0 mt-3" style="display: none" required name="fund_id">
                                <option selected disabled>Выберите фонд</option>
                                @foreach ($funds as $fund)
                                    <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Укажите необходимое количество*</label>
                            <input type="text" name="quantity" onkeyup="this.value=this.value.replace(/[^\d]/,'')" class="form-control border border-dark rounded-0"">
                        </div>
                    </div>
                    <div class="col-auto mt-2">
                            <button type="submit" class="btn btn-olives">Создать запрос</button>
                    </div>
                    <div class="col-auto mt-2">
                        <a class="btn" href="{{ route('inquiries.index') }}"> Отмена</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-none d-sm-block col-md-3 mt-4 border-left border-dark">
            <div class="row pt-1 pl-3">
                <div class="col-md-12 pt-2">
                    <p class="text-secondary">От 1 до 400 символов</p>
                </div>
                <div class="col-md-12 pt-5">
                    <p class="text-secondary">От 1 до 1 500 символов</p>
                </div>
            </div>
        </div>
    </div>
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
            }
        });
    });
</script>
@endsection