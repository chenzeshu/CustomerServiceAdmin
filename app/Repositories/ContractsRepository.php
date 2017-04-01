<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 15:09
 */

namespace App\Repositories;

use App\Contract;
use App\Customer;

class ContractsRepository
{
    public function newContract($request)
    {
        $id = $request->parentId;
//        $id = $request->customer_id;  //等contract专门做了客户单位维护再改
        //拿到正确编号
        $date = date('Ymd');
        //必须判断表里是否至少一条数据，因为新建表会没有数据----》当然，为了一点点性能考虑，为什么不手动建一条数据呢？
            $info = Contract::orderBy('id','desc')->limit(1)->pluck('contract_id');
            $number = substr($info[0], 0, 8);
            if ($number == $date){
                //假如今天是同一天
                $contract_id = $info[0]+1;
            }else{
                //假如今天是新的一天
                $contract_id = $date.'001';
            }

        $pm = serialize($request->pm);
        $tm = serialize($request->tm);
        Customer::findOrFail($id)->contracts()->create([
            'customer_name'=>$request->cus['payload']['name']  ? $request->cus['payload']['name']  : null,  //todo 三元表达式主要为了照顾第一版，转向第二版后可以删去
            'contract_id' => $request->contract_id ? $request->contract_id : $contract_id,
            'type' => $request->type,
            'contract_type'=>$request->contract_type,
            'name' => $request->name,
            'pm' => $pm,
            'tm' => $tm,
            'sum' => $request->sum,
            'time1'=>strtotime($request->time1),
            'time2'=>strtotime($request->time2),
            'time3'=>strtotime($request->time3),
            'main_unit'=>$request->main_unit,
            'desc'=>$request->desc,
        ]);
    }

    public function updateContract($request, $id)
    {
        $pm = serialize($request->pm);
        $tm = serialize($request->tm);
        if($request->contract_id){
            Contract::findOrFail($id)->update([
                'customer_id'=>$request->customer_id ? $request->customer_id : null,  //todo 三元表达式主要为了照顾第一版，转向第二版后可以删去
                'customer_name'=>$request->customer_name ? $request->customer_name  : null,  //todo 三元表达式主要为了照顾第一版，转向第二版后可以删去
                'contract_id' => $request->contract_id,
                'name' => $request->name,
                'type' => $request->type,
                'contract_type'=>$request->contract_type,
                'pm' => $pm,
                'tm' => $tm,
                'sum' => $request->sum,
                'time1'=>strtotime($request->time1),
                'time2'=>strtotime($request->time2),
                'time3'=>strtotime($request->time3),
                'main_unit'=>$request->main_unit,
                'desc'=>$request->desc,
            ]);
        }else{
            Contract::findOrFail($id)->update([
                'customer_id'=>$request->customer_id ? $request->customer_id : null,  //todo 三元表达式主要为了照顾第一版，转向第二版后可以删去
                'customer_name'=>$request->customer_name ? $request->customer_name  : null,  //todo 三元表达式主要为了照顾第一版，转向第二版后可以删去
                'name' => $request->name,
                'type' => $request->type,
                'contract_type'=>$request->contract_type,
                'pm' => $pm,
                'tm' => $tm,
                'sum' => $request->sum,
                'time1'=>strtotime($request->time1),
                'time2'=>strtotime($request->time2),
                'time3'=>strtotime($request->time3),
                'main_unit'=>$request->main_unit,
                'desc'=>$request->desc,
            ]);
        }

    }

    public function showAllContracts()
    {
        $contracts = Contract::orderBy('id','desc')->get();
        foreach ($contracts as $contract){
            $contract->pm = unserialize($contract->pm);
            $contract->tm = unserialize( $contract->tm);
        }
        return $contracts;
    }
}