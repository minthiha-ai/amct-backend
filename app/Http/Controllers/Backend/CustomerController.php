<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\UpdateCustomerPasswordRequest;

class CustomerController extends Controller
{
    //index
    public function index(){
        return view('backend.customers.index');
    }

    //edit
    public function edit(Customer $customer){
        return view('backend.customers.edit')->with(['customer' => $customer]);
    }

    //update
    public function update(UpdateCustomerRequest $request,Customer $customer){
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route('customer')->with(['updated'=>'Customer updated successfully']);
    }

    //updatePassword
    public function updatePassword(UpdateCustomerPasswordRequest $request,Customer $customer){
        $customer->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('customer')->with(['updated'=>'Customer updated successfully']);
    }

    //detail
    public function detail(Customer $customer){
        return view('backend.customers.detail')->with(['customer'=> $customer]);
    }

    //ban customer
    public function banCustomer(Customer $customer,Request $request){
        $customer->update([
            'is_banned' => $request->is_banned,
        ]);
        return response()->json([
            'customerName' => $customer->name,
        ]);
    }

    //server side
    public function serverSide()
    {
        $customers = Customer::orderBy('id','desc')->get();
        return datatables($customers)
        ->addColumn('email',function($each){
            return $each->email ?? '-----';
        })
        ->addColumn('phone',function($each){
            return $each->phone ?? '-----';
        })
        ->addColumn('action', function ($each) {
            $show_icon = '<a href="'.route('customer.detail', $each->id).'" class="btn btn-sm btn-info detail_btn mr-3"><i class="ri-eye-fill btn_icon_size"></i></a>';
            $edit_icon = '<a href="'.route('customer.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'. $show_icon .$edit_icon.'</div>';
        })
        ->addColumn('is_banned', function ($each) {
            if($each->is_banned == '0'){
                $ban_btn = '<a href="#" class="btn btn-danger ban_btn"  data-id="'.$each->id  .'">Ban</a>';
            }else{
                $ban_btn = '<a href="#" class="btn btn-outline-danger unban_btn"  data-id="'.$each->id  .'">Unban</a>';
            }
            return '<div class="action_icon">'. $ban_btn .'</div>';
        })
        ->rawColumns(['action','is_banned'])
        ->toJson();
    }
}
