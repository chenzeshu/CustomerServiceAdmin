<?php

namespace App\Http\Controllers\API;

use App\Customer;
use App\Customer2;
use App\Repositories\Customer2sRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class customer2sController extends Controller
{
    protected $repo;
    function __construct(Customer2sRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer2s = Customer2::orderBy('id','desc')->get();
        return $customer2s;
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
            'customer_name' => $request->customer['payload']['name'] ,
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
        Customer2::findOrFail($id)->update([
            'name'=> $request->name,
            'phone'=>$request->phone,
            //全部迁移到第二稿时再做repository
            'customer_name'=>$request->customer['payload']['name'],
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

    public function search($contract_id, $name)
    {
        $users = $this->repo->search($contract_id, $name);

        return $users;
    }
}
