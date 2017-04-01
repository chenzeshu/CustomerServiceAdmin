<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 15:17
 */

namespace App\Repositories;

use App\Contract;
use App\Customer;

class CustomerRepository
{
    public function newCustomer($request)
    {
        Customer::create([
            'name' => $request->name,
            'addr' => $request->addr,
            'profession' => $request->profession,
            'type'=>$request->type,
        ]);
    }

    public function updateCustomer($request, $id)
    {
        Customer::findOrFail($id)->update([
            'name' => $request->name,
            'addr' => $request->addr,
            'profession' => $request->profession,
            'type'=>$request->type,
//           'thumbnail' => 'flower.jpg',
        ]);
    }

    public function showContracts($id)
    {
        $contracts = Customer::findOrFail($id)->contracts()->orderBy('id','desc')->get();
        foreach ($contracts as $contract){
            $contract->pm = unserialize($contract->pm);
            $contract->tm = unserialize( $contract->tm);
        }
        return $contracts;
    }

}