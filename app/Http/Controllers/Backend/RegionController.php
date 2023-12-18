<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class RegionController extends Controller
{
    public function index()
    {
        return view('backend.regions.index');
    }

    public function create()
    {
        return view('backend.regions.create');
    }

    public function store(StoreRegionRequest $request)
    {
        $data = $this->getRequestData($request);
        Region::create($data);
        return redirect()->route('region')->with(['created' => 'Region added successfully']);
    }

    public function edit(Region $region)
    {
        return view('backend.regions.edit')->with(['region' => $region]);
    }

    public function update(Region $region, StoreRegionRequest $request)
    {
        $data = $this->getRequestData($request);
        $region->update($data);
        return redirect()->route('region')->with(['created' => 'Region added successfully']);
    }

    public function destroy(Region $region){
        $region->deliveryFee()->delete();
        $region->delete();
        return 'success';
    }

    public function serverSide(){
        $data = Region::orderBy('id','desc');
        return datatables($data)
        ->editColumn('cod',function($each){
            if($each->cod == 1){
                return '<div class="btn btn-sm rounded bg-soft-success">Yes</div>';

            }else{
                return '<div class="btn btn-sm rounded bg-soft-danger">No</div>';

            }
        })
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.route('region.edit', $each->id).'" class="btn btn-sm btn-success mr-3 edit_btn"><i class="mdi mdi-square-edit-outline btn_icon_size"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-danger delete_btn" data-id="'.$each->id.'"><i class="mdi mdi-trash-can-outline btn_icon_size"></i></a>';

            return '<div class="action_icon">'.$edit_icon. $delete_icon .'</div>';
        })
        ->rawColumns(['name','cod','action'])
        ->toJson();
    }

    private function getRequestData($request)
    {
        return [
            'name' => $request->name,
            'cod' => $request->cod ?? '0',
        ];
    }
}