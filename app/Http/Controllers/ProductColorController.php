<?php

namespace App\Http\Controllers;

use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreColorRequest;

class ProductColorController extends Controller
{
    //index
    public function index(){
        return view('backend.product-colors.index');
    }

    //create
    public function create(){
        return view('backend.product-colors.create');
    }

    //store
    public function store(StoreColorRequest $request){
        ProductColor::create([
            'english_name' => $request->english_name,
            'myanmar_name' => $request->myanmar_name,
        ]);
        return redirect()->route('product.color')->with('created', 'Product color created Successfully');
    }

    //edit
    public function edit(ProductColor $productColor){
        return view('backend.product-colors.edit')->with(['productColor'=>$productColor]);
    }

    //update
    public function update(ProductColor $productColor,StoreColorRequest $request){
        $productColor->update([
            'english_name' => $request->english_name,
            'myanmar_name' => $request->myanmar_name,
        ]);
        return redirect()->route('product.color')->with('updated', 'Product color updated Successfully');
    }

    //destroy
    public function destroy(ProductColor $productColor){
        $productColor->delete();
        return 'success';
    }

    //serveside
    public function serverSide()
    {
        $productColor = ProductColor::orderBy('id','desc');
        return datatables($productColor)
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.route('product.color.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-danger delete_btn" data-id="'.$each->id.'"><i class="mdi mdi-trash-can-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'.$edit_icon. $delete_icon .'</div>';
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}