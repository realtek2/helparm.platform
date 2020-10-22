<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\MedicamentsCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myWarehouse()
    {
        $products = Product::where('fund_id', Auth::user()->fund_id)->get();

        return view('warehouse.my_warehouse', compact('products'));
    }

    public function allWarehouses()
    {
        $products = Product::where('fund_id', '!=', Auth::user()->fund_id)->get();

        return view('warehouse.all_warehouses', compact('products'));
    }

    public function datatable(ProductFilter $productFilter)
    {
        $query = Product::filter($productFilter)->where('fund_id', Auth::user()->fund_id);

        $products = $query->orderBy('id', 'desc')->get();

        return Datatables::of($products)
                         ->editColumn('is_urgent', function () {
                             return view('warehouse.buttons.not_urgent')
                             ->render();
                         })
                         ->editColumn('category_id', function ($products) {
                             return $products->medicamentsCategory->name;
                         })
                         ->addColumn('undefined_object', function () {
                             return view('warehouse.buttons.undefined_object')
                            ->render();
                         })
                         ->addColumn('increase_request', function ($products) {
                             return view('warehouse.buttons.increase_request', [
                                 'product' => $products
                             ])
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
                         ->rawColumns(['undefined_object','increase_request','logs', 'is_urgent'])
                         ->make(true);
    }

    public function allWarehousesDatatable(ProductFilter $productFilter)
    {
        $query = Product::filter($productFilter)->where('fund_id', '!=', Auth::user()->fund_id);

        $products = $query->orderBy('id', 'desc')->get();

        return Datatables::of($products)
                         ->editColumn('is_urgent', function () {
                             return view('warehouse.buttons.not_urgent')
                             ->render();
                         })
                         ->editColumn('category_id', function ($products) {
                             return $products->medicamentsCategory->name;
                         })
                         ->editColumn('fund_id', function ($products) {
                             return view('warehouse.buttons.fund_and_address', [
                                 'fundName' => $products->fund->name,
                                 'fundAddress' => $products->fund->country . ' ' . $products->fund->city,
                             ]);
                         })
                         ->addColumn('request_product', function ($products) {
                             return view('warehouse.buttons.request_product', [
                                'id' => $products->id
                            ])->render();
                         })
                         ->rawColumns(['fund_id', 'is_urgent'])
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

    public function changeQuantity(Product $product)
    {
        return view('warehouse.crud.change_quantity', compact('product'));
    }

    public function storeQuantity(Request $request, $productId)
    {
        $product = Product::findOrfail($productId);
        $product->quantity = $request->quantity;
        $product->save();

        return back();
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
