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
            'contract_id' => $contract_id,
            'type' => $request->type,
            'name' => $request->name,
            'pm' => $pm,
            'tm' => $tm,
            'sum' => $request->sum,
            'active' =>$request->active
        ]);
    }

    public function updateContract($request, $id)
    {
        $pm = serialize($request->pm);
        $tm = serialize($request->tm);
        Contract::findOrFail($id)->update([
//            'contract_id' => $request->contractId,
            'name' => $request->name,
            'pm' => $pm,
            'tm' => $tm,
            'sum' => $request->sum,
            'active' =>$request->active
        ]);
    }


}