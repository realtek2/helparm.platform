<?php

namespace App\Http\Controllers;

use App\Models\Fund;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::with('answers', 'products')->orderBy('id', 'desc')->latest()->paginate(10);
        
        return view('fund.index', [
            'funds' => $funds
            ])->with((request()->input('page', 1) - 1) * 10);
    }

    public function list()
    {
        $funds = Fund::with('answers', 'products')->orderBy('id', 'desc')->latest()->paginate(10);
        
        return view('admin.fund.index', [
            'funds' => $funds
            ])->with((request()->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fund.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Fund::create($this->validateFund());

        return redirect(route('funds.index'))->with('success', 'Создан новый фонд.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        return view('fund.show', compact('fund'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        return view('fund.edit', compact('fund'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Fund $fund)
    {
        $fund->update($this->validateFund());

        return redirect(route('funds.index'))->with('success', 'Фонд обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        $fund->delete();

        return redirect(route('funds.index'))->with('success', 'Фонд удалён.');
    }

    protected function validateFund()
    {
        return request()->validate([
            'name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'email' => 'required',
            'number' => 'required',
            'description' => 'nullable',
            ]);
    }
}
