<?php

namespace App\Http\Controllers;

use App\Models\Nomenclature;
use Illuminate\Http\Request;

class NomenclatureController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $nomenclatures = Nomenclature::paginate(10);
        return view('admin.nomenclature.index', compact('nomenclatures'))->with((request()->input('page', 1) - 1) * 10);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.nomenclature.create');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nomenclature  $nomenclature
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomenclature $nomenclature)
    {
        return view('admin.nomenclature.edit', compact('nomenclature'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Nomenclature::create($this->validateNomenclature());

        return redirect(route('admin.nomenclatures.index'))->with('success', 'Создан новый фонд.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nomenclature  $nomenclature
     * @return \Illuminate\Http\Response
     */
    public function update(Nomenclature $nomenclature)
    {
        $nomenclature->update($this->validateNomenclature());

        return redirect(route('admin.nomenclatures.index'))->with('success', 'Номенклатура обновлёна.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nomenclature  $nomenclature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomenclature $nomenclature)
    {
        $nomenclature->delete();

        return redirect(route('admin.nomenclatures.index'))->with('success', 'Номенклатура удалёна.');
    }

    protected function validateNomenclature()
    {
        return request()->validate(['name' => 'required']);
    }
}
