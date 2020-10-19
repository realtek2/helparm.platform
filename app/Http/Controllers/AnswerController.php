<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\MedicamentInquiry;
use App\Models\Product;
use App\Models\ProductAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
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
        //
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
            'quantity' => 'required',
            'comment' => 'nullable',
            'delivery_period' => 'required'
        ]);
        
        $inquiry = MedicamentInquiry::findOrFail($inquiryId);
        $input = $request->all();
        
        $input['fund_id'] = Auth::user()->fund_id;
        $input['inquiry_id'] = $inquiryId;
        
        $inquiry = MedicamentInquiry::find($inquiryId);
        $answer = new Answer($input);

        $inquiry->answers()->save($answer);

        
        ProductAnswer::updateOrCreate([
            'product_id' => $request->product_id,
            'answer_id' => $answer->id,
        ]);

        return redirect(route('inquiries.show', ['inquiry' => $inquiryId]))->with('success', 'Запрос создан.');
    }

    public function acceptAnswer($answerId)
    {
        $answer = Answer::findOrfail($answerId);
        $answer->delivery_status = Answer::DELIVERY_ASNWER_CONFIRMED;
        $answer->save();

        return response()->json([
            'type'    => 'success',
            'message' => 'Ответ на запрос принят',
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::destroy($id);

        return redirect(route('home'));
    }
}
