<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 15:17
 */

namespace App\Repositories;

use App\Customer;

class CustomerRepository
{
    public function newCustomer($request)
    {
        Customer::create([
            'name' => $request->name,
            'addr' => $request->addr,
            'profession' => $request->profession,
        ]);
    }

    public function updateCustomer($request, $id)
    {
        Customer::findOrFail($id)->update([
            'name' => $request->name,
            'addr' => $request->addr,
            'profession' => $request->profession,
//           'thumbnail' => 'flower.jpg',
        ]);
    }
}