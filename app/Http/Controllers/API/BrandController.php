<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;

class BrandController extends BaseController
{
    //index
    public function index()
    {
        $data = Brand::orderBy('id', 'DESC')->get();
        if(!count($data)){
            return $this->sendError(204,'No Data Found');
        }
        return $this->sendResponse('success',$data);

    }
}