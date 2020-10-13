<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\MedicamentInquiry;
use App\Models\MedicamentsCategory;
use Illuminate\Http\Request;

class MedicamentInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = MedicamentInquiry::latest()->paginate(5);

        return view('inquiry.index', compact('inquiries'))
             ->with((request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MedicamentsCategory::all();
        $funds = Fund::all();

        return view('inquiry.create', compact('categories', 'funds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'request_to_all' => 'nullable|boolean',
            'quantity' => 'required',
            'category_id' => 'required',
            'fund_id' => 'nullable'
        ]);

        $input = $request->all();
        MedicamentInquiry::create($input);

        return redirect(route('inquiries.index'))->with('success', 'Запрос создан.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicamentInquiry  $medicamentInquiry
     * @return \Illuminate\Http\Response
     */
    public function show(MedicamentInquiry $medicamentInquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicamentInquiry  $medicamentInquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicamentInquiry $medicamentInquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicamentInquiry  $medicamentInquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicamentInquiry $medicamentInquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicamentInquiry  $medicamentInquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicamentInquiry $medicamentInquiry)
    {
        //
    }
}
