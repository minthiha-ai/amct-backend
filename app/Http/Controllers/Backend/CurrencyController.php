<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Currency::get();
        return view('backend.currencies.index')->with('data',$data);
        // return view('backend.currencies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kyats' => 'required|regex:/^[A-Za-z0-9.]+$/',
        ]);

        $validator->messages()->add('kyats.regex', 'The :attribute may only contain letters, numbers, and periods.');

        if ($validator->fails()) {
            // Validation failed
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Currency::create([
            'kyats'=> $request->kyats
        ]);
        return to_route('currencies.index')->with('success','Currency Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Currency::findOrFail($id);
        return view('backend.currencies.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Currency $currency)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'kyats' => 'required|regex:/^[A-Za-z0-9.]+$/',
        ]);

        $validator->messages()->add('kyats.regex', 'The :attribute may only contain letters, numbers, and periods.');

        if ($validator->fails()) {
            // Validation failed
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $currency->update(['kyats'=> $request->kyats]);

        return to_route('currencies.index')->with('success','Currency Added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $currency = Currency::findOrFail($id);
        // return $currency;
        $currency->delete();

        return back();
    }
}
