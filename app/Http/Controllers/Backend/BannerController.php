<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBannerRequest;

class BannerController extends Controller
{
    //index
    public function index(){
        return view('backend.banners.index');
    }

    //create
    public function create(){
        return view('backend.banners.create');
    }

    //store
    public function store(StoreBannerRequest $request){

        $data = [
            'title' => $request->title
        ];
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('banners');
        }

        Banner::create($data);
        return redirect()->route('banner')->with(['created'=>'Banner created successfully']);
    }

    //edit
    public function edit(Banner $banner){
        return view('backend.banners.edit')->with(['banner'=>$banner]);
    }

    //update
    public function update(StoreBannerRequest $request,Banner $banner){
        $updatedData = [
            'title' => $request->title,
        ];
        if($request->hasFile('image')){
            //delete old img
            $oldImage = $banner->getRawOriginal('image') ?? '';
            Storage::delete($oldImage);

            //store new img
            $updatedData['image'] = $request->file('image')->store('banners');

        }
        $banner->update($updatedData);
        return redirect()->route('banner')->with(['updated'=>'Banner updated successfully']);
    }

    //delete
    public function destroy(Banner $banner){
        //delete image
        $image = $banner->getRawOriginal('image') ?? '';
        Storage::delete($image);
        //delete banner
        $banner->delete();
        return 'success';
    }

    //data table
    public function serverSide(){
        $banner = Banner::orderBy('id','desc');
        return datatables($banner)
        ->addColumn('image', function ($each) {
            return '<img src="'.$each->image.'" class="thumbnail_img"/>';
        })
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.route('banner.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-danger delete_btn" data-id="'.$each->id.'"><i class="mdi mdi-trash-can-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'.$edit_icon. $delete_icon .'</div>';
        })
        ->rawColumns(['image', 'action'])
        ->toJson();
    }
}