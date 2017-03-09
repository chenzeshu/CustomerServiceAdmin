<?php

namespace App\Http\Controllers;

use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $serviser = $request->serviser;
        $customer2 = $request->customer2;
        $visitor = $request->visitor;
        Service::create([
            's_id'=> 20170303,
            's_id2'=>20170303,
            'contract_id'=>$request->contract_id,
            "source"=>$request->source,
            "type"=>$request->type,
            "desc1"=>$request->desc1,
            "serviser"=>serialize($serviser),
            "charge_if"=> $request->charge_if,
            "customer2"=> serialize($customer2),
            "customer2_id"=> 1,
            "time1"=>toTime($request->time1),
            "time2"=>toTime($request->time2),
            "desc2"=>$request->desc2,
            "result_deal"=>$request->result_deal,
            "remark" => $request->remark,
            "rating"=>$request->rating,
            "visitor"=>serialize($visitor),
            "time3"=>toTime($request->time3),
            "result_visit"=>$request->result_visit,
            "time4"=>$request->time4,
            "files"=> "暂时不搞",
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
