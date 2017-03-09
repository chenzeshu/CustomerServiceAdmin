<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 18:46
 */

namespace App\Repositories;


use App\Service;

class ServicesRepository
{
    public function newService($request)
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

    public function updateService($request,$id)
    {
        $serviser = $request->serviser;
        $customer2 = $request->customer2;
        $visitor = $request->visitor;
        Service::findOrFail($id)->update([
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
}