<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //send success api response
    public function sendResponse($message,$data = null)
    {
    	$response = [
            'success' => true,
            'message' => $message,
        ];

        if(!empty($data)){
            $response['data'] = $data;
        }

        return response()->json($response, 200);
    }

    //send error api response
    public function sendError($status,$message,$data = null)
    {
    	$response = [
            'success' => false,
            'message' => $message,
        ];
        if(!empty($data)){
            $response['data'] = $data;
        }
        return response()->json($response,$status);
    }
}