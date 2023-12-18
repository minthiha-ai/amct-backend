<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    //index
    public function index(){
        return view('backend.payments.index');
    }

    //create
    public function create(){
        return view('backend.payments.create');
    }

    //store
    public function store(StorePaymentRequest $request){
        $data = $this->getRequestPaymentData($request);

        //image
        if($request->hasFile('image')){
            $data['payment_logo'] = $request->file('image')->store('payments');
        }

        Payment::create($data);
        return redirect()->route('payment')->with(['created' => 'Payment created successfully']);
    }

    //edit
    public function edit(Payment $payment){
        return view('backend.payments.edit')->with(['payment'=>$payment]);
    }

    //update
    public function update(UpdatePaymentRequest $request,Payment $payment){
        $data = $this->getRequestPaymentData($request);
        //mge
        if($request->hasFile('image')){
            //delete old image
            $oldImage = $payment->getRawOriginal('payment_logo') ?? '';
            Storage::delete($oldImage);

            //new image
            $data['payment_logo'] = $request->file('image')->store('payments');
        }

        $payment->update($data);
        return redirect()->route('payment')->with(['updated'=>'Payment updated successfully']);
    }


    //destroy
    public function destroy(Payment $payment){
        $payment->update([
            'status' => '0'
        ]);
        return 'success';
    }


    //data table
    public function serverSide(){
        $payment = Payment::activePayment()->orderBy('id','desc');
        return datatables($payment)
        ->addColumn('image', function ($each) {
            return '<img src="'.$each->payment_logo.'" class="thumbnail_img"/>';
        })
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.route('payment.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-danger delete_btn" data-id="'.$each->id.'"><i class="mdi mdi-trash-can-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'.$edit_icon. $delete_icon .'</div>';
        })
        ->rawColumns(['image','payment_type','name','number','action'])
        ->toJson();
    }

    //request payment data
    private function getRequestPaymentData($request){
        return [
            'payment_type' => $request->payment_type,
            'name' => $request->name,
            'number' => $request->number,
            'status'=> '1',
        ];
    }
}
