<?php

namespace App\Http\Controllers;

use App\Models\OrderSuccessMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrderSuccessMessageController extends Controller
{
    public function index(){
        return view('backend.order-success-message.index');
    }
    //create
    public function create(){
        if(OrderSuccessMessage::count() == 1){
            return back()->with(['infoMessage'=>'Order success message တခုထက်ပို၍ အသစ်ဖန်တီးမရပါ။']);
        }
        return view('backend.order-success-message.create');
    }

    public function store(Request $request){
        $request->validate(['message' => ['required']]);
        OrderSuccessMessage::create(['message'=>$request->message]);
        return redirect()->route('orderSuccessMessage')->with(['created'=>'အောင်မြင်ပါသည်']);
    }

    public function edit(OrderSuccessMessage $orderSuccessMessage){
        return view('backend.order-success-message.edit')->with(['orderSuccessMessage'=>$orderSuccessMessage]);
    }

    public function update(OrderSuccessMessage $orderSuccessMessage,Request $request){
        $request->validate(['message'=>['required']]);
        $orderSuccessMessage->update(['message'=>$request->message]);
        return redirect()->route('orderSuccessMessage')->with(['updated'=>'အောင်မြင်ပါသည်']);
    }

    public function destroy(OrderSuccessMessage $orderSuccessMessage){
        $orderSuccessMessage->delete();
        return 'success';
    }

    public function serverSide(){
        $data = OrderSuccessMessage::orderBy('id','desc');
        return datatables($data)

        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.route('orderSuccessMessage.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-danger delete_btn" data-id="'.$each->id.'"><i class="mdi mdi-trash-can-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'.$edit_icon. $delete_icon .'</div>';
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}