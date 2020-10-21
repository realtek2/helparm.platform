<div class="col-md-3">
    <div class="form-group">
        <input type="text" name="name" class="form-control search-input" placeholder="Введите название товара">
    </div>
</div>
<div class="col-md-2 ml-n3">
    <select class="custom-select form-control search-input" name="medicaments_category">
        <option value="">Выберите категорию</option> 
        @foreach (App\Models\MedicamentsCategory::all() as $medicaments_category)
            <option value="{{ $medicaments_category->id}}">{{ $medicaments_category->name }}</option>
        @endforeach
    </select>
</div>
<div class="col-md-1 ml-n3 mr-n1">
    <button type="button" id="search-products" class="btn btn-primary search-button px-4">Найти</button>
</div>
<div class="col-md-2 ml-n1">
    <button type="button" id="reset_search" class="btn btn-warning search-button px-4">Сбросить поиск</button>
</div>