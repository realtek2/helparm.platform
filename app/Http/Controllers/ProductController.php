<?php

namespace App\Http\Controllers;

use App\Models\MedicamentsCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myWarehouse()
    {
        $products = Product::where('fund_id', Auth::user()->fund_id)->sortable('id')->paginate(5);

        return view('warehouse.my_warehouse', compact('products'))->with((request()->input('page', 1) - 1) * 5);
    }

    public function allWarehouses()
    {
        $products = Product::where('fund_id', '!=', Auth::user()->fund_id)->latest()->paginate(5);

        return view('warehouse.all_warehouses', compact('products'))->with((request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $products = Product::where('fund_id', '!=', Auth::user()->fund_id)->get();

        return Datatables::of($products)
                         ->editColumn('name', function ($products) {
                             return $products->medicamentsCategory->name;
                         })
                         ->editColumn('category_id', function ($products) {
                             return $products->medicamentsCategory->name;
                         })
                         ->addColumn('undefined_object', function () {
                             return view('warehouse.buttons.undefined_object')
                            ->render();
                         })
                         ->addColumn('increase_request', function () {
                             return view('warehouse.buttons.increase_request')
                             ->render();
                         })
                         ->addColumn('logs', function () {
                             return view('warehouse.buttons.logs')
                            ->render();
                         })
                         ->addColumn('move_button', function ($products) {
                             return view('warehouse.buttons.move_button', [
                                 'id' => $products->id
                             ])->render();
                         })
                         ->rawColumns(['undefined_object','increase_request','logs'])
                         ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MedicamentsCategory::all();
        
        return view('warehouse.crud.create_modal', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateProduct();
        $input = $request->all();
        $input['free'] = $request->quantity;
        $input['fund_id'] = Auth::user()->fund_id;
       
        Product::create($input);

        return redirect(route('products.my_warehouse'))->with('success', 'Товар создан.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = MedicamentsCategory::all();

        return view('warehouse.crud.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($this->validateProduct());

        return redirect(route('products.my_warehouse'))->with('success', 'Товар обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('products.my_warehouse'))->with('success', 'Товар удалён.');
    }

    protected function validateProduct()
    {
        return request()->validate([
            'name' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'unit' => 'required'
        ]);
    }
}
