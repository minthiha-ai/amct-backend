<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use App\Models\DeliveryFee;

class DeliveryFeeController extends BaseController
{
    //
    public function list(){
        $data = DeliveryFee::with('region')->get();
        if(!count($data)){
            return $this->sendError(204,'No Data Found');
        }
        return $this->sendResponse('success',$data);
    }

    public function detail($id){
        $deliveryFee = DeliveryFee::with('region')->where('id',$id)->get();
        if(count($deliveryFee)){
            return $this->sendResponse('success',$deliveryFee);
        }
        return $this->sendError(204,'No Data Found');
    }

    public function deliveryFeeByRegion($id){
        $deliveryFee = DeliveryFee::where('region_id',$id)->get();
        if(count($deliveryFee)){
            return $this->sendResponse('success',$deliveryFee);
        }
        return $this->sendError(204,'No Data Found');
    }
}