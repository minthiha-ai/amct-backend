<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\FcmTokenKey;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Controllers\API\BaseController;

class AuthController extends BaseController
{
    //login
    public function login(LoginRequest $request)
    {
        if (Auth::guard('api')->user()) {
            return $this->sendError(401, 'Already login!');
        }

        $customer = Customer::withCount('fcmTokenKey')->orWhere('email', $request->emailOrPhone)->orWhere('phone', $request->emailOrPhone)->first();
        if ($customer->fcm_token_key_count >= 5) {
            $firstFcmTokenKey = FcmTokenKey::where('customer_id', $customer->id)->first();
            $firstFcmTokenKey->update([$request->fcm_token_key]);
        } else {
            FcmTokenKey::create([
                'customer_id' => $customer->id,
                'fcm_token_key' => $request->fcm_token_key,
            ]);
        }

        $hashPassword = $customer->password;
        if (Hash::check($request->password, $hashPassword)) {
            return response()->json([
                'success' => true,
                'token' => $customer->createToken(config('app.companyInfo.name'))->accessToken,
                'data' => new CustomerResource($customer),
            ], 200);
        } else {
            return $this->sendError(401, 'Credentials do not match');
        }
    }

    //register
    public function register(RegisterRequest $request)
    {
        // return $request->all();
        // if (Auth::guard('api')->user()) {
        //     return $this->sendError(401, 'Already login!');
        // }

        $data = $this->getCustomerRequestData($request);
        $customer = Customer::create($data);
        FcmTokenKey::create([
            'customer_id' => $customer->id,
            'fcm_token_key' => $request->fcm_token_key,
        ]);

        if ($customer) {
            return response()->json([
                'success' => true,
                'token' => $customer->createToken('MYAPP')->accessToken,
                'data' => new CustomerResource($customer),
            ], 200);
        }

        return $this->sendError(401, 'Register Fail! Try Again.');
    }

    //logout
    public function logout()
    {
        $customer = Auth::guard('api')->user()->token();
        $customer->revoke();
        return $this->sendResponse('Logout successfully');
    }

    private function getCustomerRequestData($request)
    {
        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ];
        if ($request->email) {
            $data['email'] = $request->email;
        }
        if ($request->phone) {
            $data['phone'] = $request->phone;
        }

        return $data;
    }
}
