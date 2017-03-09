<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Customer;
use App\Repositories\ContractsRepository;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    protected $con;

    public function __construct(ContractsRepository $con)
    {
        $this->middleware('auth');
        $this->con = $con;
    }
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
        $this->con->newContract($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = Contract::findOrFail($id)->services()->get();
        foreach ($services as $service){
            $service->serviser = unserialize($service->serviser);
            $service->customer2 = unserialize($service->customer2);
            $service->visitor = unserialize($service->visitor);
        };
        return view('contracts.index',compact('services','id'));
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
        $this->con->updateContract($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contract::findOrFail($id)->delete();
    }
}
