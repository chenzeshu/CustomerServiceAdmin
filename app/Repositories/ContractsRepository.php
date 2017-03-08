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

        Customer::findOrFail($id)->contracts()->create([
            'contract_id' => $request->contractId,
            'type' => $request->type,
            'name' => $request->name,
            'pm' => $request->pm,
            'tm' => $request->tm,
            'sum' => $request->sum,
            'active' =>$request->active
        ]);
    }

    public function updateContract($request, $id)
    {
        Contract::findOrFail($id)->update([
            'contract_id' => $request->contractId,
            'name' => $request->name,
            'pm' => $request->pm,
            'tm' => $request->tm,
            'sum' => $request->sum,
            'active' =>$request->active
        ]);
    }


}