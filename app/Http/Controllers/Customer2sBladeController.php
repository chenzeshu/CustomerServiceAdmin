<?php

namespace App\Http\Controllers;

use App\Customer2;
use App\Http\Requests\CreateCustomer2Request;
use App\Http\Requests\UpdateCustomer2Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * 用于blade模版的restfult API
 */
class Customer2sBladeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer2s = Customer2::paginate(10);
        return view('customer2s.index', compact('customer2s'));
    }

    public function searchCus2Name(Request $request)
    {
        $customer2s = Customer2::where('name', 'like', '%'.$request->searchcus2name.'%')->paginate(10);
        return view('customer2s.index', compact('customer2s'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomer2Request $request)
    {
        Customer2::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'customer_name' =>$request->customer_name,
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomer2Request $request, $id)
    {
        Customer2::findOrFail($id)->update([
            'name'=> $request->name,
            'phone'=>$request->phone,
            'customer_name'=>$request->customer_name,
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer2::findOrFail($id)->delete();
        return Redirect::back();
    }
}
