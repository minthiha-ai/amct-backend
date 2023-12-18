<?php

namespace App\Http\Controllers\Backend;

use App\Models\DeliveryFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreDeliveryFeeRequest;
use App\Models\Region;

class DeliveryFeeController extends Controller
{
    //index
    public function index()
    {
        return view('backend.delivery-fee.index');
    }

    //create
    public function create()
    {
        $regions = Region::orderBy('id','desc')->get();
        return view('backend.delivery-fee.create')->with(['regions'=>$regions]);
    }

    //store
    public function store(StoreDeliveryFeeRequest $request)
    {
        $data = $this->getRequestData($request);
        DeliveryFee::create($data);
        return redirect()->route('deliveryfee')->with(['created' => 'Delivery Fee added successfully']);
    }

    //edit
    public function edit(DeliveryFee $deliveryFee){
        $deliveryFee->with('region')->first();
        $regions = Region::orderBy('id','desc')->get();
        return view('backend.delivery-fee.edit')->with(['deliveryFee'=>$deliveryFee,'regions'=>$regions]);
    }

    //store
    public function update(StoreDeliveryFeeRequest $request,DeliveryFee $deliveryFee)
    {
        $data = $this->getRequestData($request);
        $deliveryFee->update($data);
        return redirect()->route('deliveryfee')->with(['created' => 'Delivery Fee added successfully']);
    }

    //destroy
    public function destroy(DeliveryFee $deliveryFee){
        $deliveryFee->delete();
        return 'success';
    }

    //server side

    public function serverSide(){
        $data = DeliveryFee::with('region')->orderBy('id','desc')->get();
        return datatables($data)
        ->editColumn('region',function($each){
            return $each->region->name;
        })
        ->editColumn('city',function($each){
            return $each->city;
        })
        ->editColumn('fee',function($each){
            return number_format($each->fee)." MMK";
        })
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.route('deliveryfee.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-danger delete_btn" data-id="'.$each->id.'"><i class="mdi mdi-trash-can-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'.$edit_icon. $delete_icon .'</div>';
        })
        ->rawColumns(['region','city','fee','action'])
        ->toJson();
    }

    private function getRequestData($request)
    {
        return [
            'region_id' => $request->region_id,
            'city' => $request->city,
            'fee' => $request->fee,
        ];
    }
}
