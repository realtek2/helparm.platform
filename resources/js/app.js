window.filterInquiries = function () {
    const params = {
        season: $('.inquiries:checked').val(),
    }

    var queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');
}


window.radioFilter = function (item, val) {
    const parent = $(item).closest('.inquiries-list');
    $(parent).find('label').removeClass('active');
    $(item).closest('label').addClass('active');
    filterInquiries();
}

// $(document).ready(function () {
//     filterInquiries();
// })
const new_products_field = `
<div class="col-xs-12 col-sm-12 col-md-12 product_category">
   <div class="form-group">
       <label>Выберите товар со склада:*</label>
       <select class="custom-select" required name="product_id[]">
           <option selected disabled>Выберите товар</option>
           @foreach ($products as $product)
               @if($product->fund_id == Auth::user()->fund_id )
                   <option value="{{ $product->id }}">{{ $product->name }}</option>
               @endif
           @endforeach
       </select>
   </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 product_quantity">
   <div class="form-group">
       <label>Количество шт.*</label>
       <input type="text" name="quantity" class="form-control" required placeholder="Количество">
   </div>
</div>
`;
window.addProduct = function() {
    $('.new_products_fields').show();
    $('.new_products_fields').append(new_products_field);
}