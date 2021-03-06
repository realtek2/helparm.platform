<?php

namespace App\Http\Controllers;

use App\Models\MedicamentInquiry;
use App\Models\Product;
use App\Models\ProductAnswer;
use Illuminate\Http\Request;

class ProductAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productAnswer = ProductAnswer::all();
        $products = Product::all();
        return view('inquiry.product_answers.add_modal', compact('products', 'productAnswer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $inquiryId)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
            'comment' => 'nullable',
            'delivery_period' => 'required'
        ]);
        $inquiry = MedicamentInquiry::findOrFail($inquiryId);
        $input = $request->all();
        
        $input['inquiry_id'] = $inquiryId;
        $inquiry = MedicamentInquiry::find($inquiryId);
        $productAnswer = new ProductAnswer($input);

        $inquiry->answers()->save($productAnswer);

        return redirect(route('inquiries.show', ['inquiry' => $inquiryId]))->with('success', 'Запрос создан.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAnswer  $productAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAnswer $productAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAnswer  $productAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAnswer $productAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductAnswer  $productAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAnswer $productAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAnswer  $productAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAnswer $productAnswer)
    {
        //
    }
}
