<?php
namespace App\Filters;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ProductFilter extends QueryFilter
{
    public function getModelClass()
    {
        return Product::class;
    }

    public function medicamentsCategory($category_id)
    {
        $this->builder->whereHas('medicamentsCategory', function ($query) use ($category_id) {
            $query->WhereRaw("category_id like '%$category_id%'");
        });
    }
    
    public function name($query)
    {
        return $this->builder->where('name', 'like', '%'.$query.'%')->orWhere('id', 'like', '%'.$query.'%');
    }
}
