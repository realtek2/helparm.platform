<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Fund;
use App\Models\MedicamentInquiry;
use App\Models\MedicamentsCategory;
use App\Models\Product;
use App\Models\ProductAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicamentInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all();
        $inquiries = MedicamentInquiry::latest()->paginate(5);
    
        return view('inquiry.index', compact('inquiries', 'answers'))
             ->with((request()->input('page', 1) - 1) * 5);
    }

    public function list()
    {
        $inquiries = MedicamentInquiry::latest()->paginate(5);

        return view('admin.inquiry.index', compact('inquiries'))
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
        $this->validateIquiry();
        $input = $request->all();
        $input['created_by_fund'] = Auth::user()->fund_id;
        
        MedicamentInquiry::create($input);

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
        $answer_id = isset(Answer::where('inquiry_id', $inquiry->id)->where('fund_id', Auth::user()->fund_id)->get()->first()->id)
                     ? Answer::where('inquiry_id', $inquiry->id)->where('fund_id', Auth::user()->fund_id)->get()->first()->id
                     : null;
        $answer_fund_id = isset(Answer::find($answer_id)->fund_id) ? Answer::find($answer_id)->fund_id : null;

        $countSendedProducts = Answer::selectRaw('sum(quantity) as total')
                                     ->where('inquiry_id', $inquiry->id)
                                     ->where('delivery_status', Answer::DELIVERY_SENT)
                                     ->first();

        $countDeliveredProducts = Answer::selectRaw('sum(quantity) as total')
                                     ->where('inquiry_id', $inquiry->id)
                                     ->where('delivery_status', Answer::DELIVERED)
                                     ->first();

        $answers = Answer::where('inquiry_id', $inquiry->id)->get();

        $fundAnswers = Answer::where('inquiry_id', $inquiry->id)->where('fund_id', Auth::user()->fund_id)->get();
        $productAnswers = ProductAnswer::where('answer_id', $answer_id)->with(['product'])->get();

        $products = Product::all();
        $funds = Fund::all();

        return view('inquiry.show', compact(
            'inquiry',
            'funds',
            'products',
            'answer_id',
            'answer_fund_id',
            'answers',
            'fundAnswers',
            'productAnswers',
            'countSendedProducts',
            'countDeliveredProducts',
        ));
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
