<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{

    //index
    public function index(){
        return view('backend.product-sizes.index');
    }

    //create
    public function create(){
        return view('backend.product-sizes.create');
    }

    //store
    public function store(Request $request){
        ProductSize::create([
            'name' => $request->name
        ]);
        return redirect()->route('product.size')->with('created', 'Product size created Successfully');
    }

    //edit
    public function edit(ProductSize $productSize){
        return view('backend.product-sizes.edit')->with(['productSize'=>$productSize]);
    }

    //update
    public function update(ProductSize $productSize,Request $request){
        $request->validate([
            'name' =>'required'
        ]);
        $productSize->update(['name'=>$request->name]);
        return redirect()->route('product.size')->with('updated', 'Product size updated Successfully');
    }

    //destroy
    public function destroy(ProductSize $productSize){
        $productSize->delete();
        return 'success';
    }

    //serveside
    public function serverSide()
    {
        $productSize = ProductSize::orderBy('id','desc');
        return datatables($productSize)
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.route('product.size.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-danger delete_btn" data-id="'.$each->id.'"><i class="mdi mdi-trash-can-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'.$edit_icon. $delete_icon .'</div>';
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}
