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
    public function store()
    {
        MedicamentInquiry::create($this->validateIquiry());

        return redirect(route('inquiries.index'))->with('success', 'Запрос создан.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicamentInquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(MedicamentInquiry $inquiry)
    {
        return view('inquiry.show', compact('inquiry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicamentInquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicamentInquiry $inquiry)
    {
        $categories = MedicamentsCategory::all();
        $funds = Fund::all();

        return view('inquiry.edit', compact('inquiry', 'categories', 'funds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicamentInquiry  $medicamentInquiry
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validateIquiry();
        $input = $request->all();
        
        if ($input['request_to_all'] == 1) {
            $input['fund_id'] = null;
        }

        $medicamentInquiry = MedicamentInquiry::findOrFail($id);
        $medicamentInquiry->update($input);

        return redirect(route('inquiries.index'))->with('success', 'Запрос обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicamentInquiry  $medicamentInquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MedicamentInquiry::destroy($id);

        return redirect(route('inquiries.index'))->with('success', 'Запрос удалён.');
    }

    protected function validateIquiry()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'nullable',
            'request_to_all' => 'nullable|boolean',
            'quantity' => 'required',
            'category_id' => 'required',
            'fund_id' => 'nullable'
        ]);
    }
}
