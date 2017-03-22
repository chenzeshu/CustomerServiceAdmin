<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Customer;
use App\Customer2;
use Illuminate\Http\Request;

class Customer2sController extends Controller
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
    public function store(Request $request)
    {
        Customer2::create([
           'name' => $request->name,
            'phone' => $request->phone,
            'customer_name' =>$request->customer['name']
        ]);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Customer2::findOrFail($id)->update([
            'name'=> $request->name,
            'phone'=>$request->phone,
            'customer_name'=>$request->customer['name'],
        ]);
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
    }

    public function showList($contract_id,$name)
    {
        if ($name == "all"){
            $cus2 = Contract::findOrFail($contract_id)
                ->customer()->first()
                ->customer2s()->select('id', 'name')->limit(10)->get();
        }else{
            $cus2= Contract::findOrFail($contract_id)
                ->customer()->first()
                ->customer2s()->where('name', 'like',"%".$name."%")->select('id', 'name')->limit(10)->get();
        }


        return $cus2;
    }
}
