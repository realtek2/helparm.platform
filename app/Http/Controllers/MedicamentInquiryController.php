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
        $inquiries = MedicamentInquiry::latest()->paginate(10);
    
        foreach ($inquiries as $inquiry) {
            $two_weeks_inquiries = $inquiry->where('created_at', '<=', now()->subDays(14))->get();
            if ($two_weeks_inquiries->count() >= 1) {
                foreach ($two_weeks_inquiries as $two_weeks_inquiry) {
                    $two_weeks_inquiry->status = 2;
                    $two_weeks_inquiry->save();
                }
            }
        }

        return view('inquiry.index', compact('inquiries', 'answers'))
             ->with((request()->input('page', 1) - 1) * 10);
    }

    public function list()
    {
        $inquiries = MedicamentInquiry::latest()->paginate(10);

        return view('admin.inquiry.index', compact('inquiries'))
             ->with((request()->input('page', 1) - 1) * 10);
    }

    public function newInquiries()
    {
        $inquiries = MedicamentInquiry::where('status', MedicamentInquiry::NEW_INQUIRY)->latest()->paginate(10);
        $answers = Answer::all();
        
        return view('inquiry.index', compact('inquiries', 'answers'))
             ->with((request()->input('page', 1) - 1) * 5);
    }

    public function inProcess()
    {
        $inquiries = MedicamentInquiry::where('status', MedicamentInquiry::IN_PROCESS)->latest()->paginate(10);
        $answers = Answer::all();
        
        return view('inquiry.index', compact('inquiries', 'answers'))
             ->with((request()->input('page', 1) - 1) * 5);
    }

    public function archived()
    {
        $inquiries = MedicamentInquiry::where('status', MedicamentInquiry::ARCHIVED)->latest()->paginate(10);
        $answers = Answer::all();
        
        return view('inquiry.index', compact('inquiries', 'answers'))
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
        $input['status'] = 1;
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
        
        $countSendedProducts = ProductAnswer::rightJoin('answers', 'product_answers.answer_id', '=', 'answers.id')
                                            ->selectRaw('sum(quantity) as total')
                                            ->where('delivery_status', Answer::DELIVERY_SENT)
                                            ->first();
       
        $countDeliveredProducts = ProductAnswer::rightJoin('answers', 'product_answers.answer_id', '=', 'answers.id')
                                                ->selectRaw('sum(quantity) as total')
                                                ->where('delivery_status', Answer::DELIVERED)
                                                ->first();
        return view(
            'inquiry.show',
            [
                'inquiry' => $inquiry,
                'funds' => Fund::all(),
                'products' => Product::all(),
                'answer_id' => $answer_id,
                'answer_fund_id' => isset(Answer::find($answer_id)->fund_id) ? Answer::find($answer_id)->fund_id : null,
                'answers' => Answer::where('inquiry_id', $inquiry->id)->get(),
                'fundAnswers' => Answer::where('inquiry_id', $inquiry->id)->where('fund_id', Auth::user()->fund_id)->get(),
                'productAnswers' => ProductAnswer::where('answer_id', $answer_id)->with(['product'])->get(),
                'countSendedProducts' => $countSendedProducts,
                'countDeliveredProducts' => $countDeliveredProducts,
            ]
        );
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

    public function closeInquiry($id)
    {
        $inquiry = MedicamentInquiry::findOrFail($id);
        $inquiry->status = MedicamentInquiry::ARCHIVED;
        $inquiry->save();

        return redirect(route('inquiries.index'));
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
