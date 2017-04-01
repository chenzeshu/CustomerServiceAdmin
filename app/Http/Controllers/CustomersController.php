<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Customer;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Repositories\CustomerRepository;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;

class CustomersController extends Controller
{
    protected $cus;

    public function __construct(CustomerRepository $cus)
    {
        $this->middleware('auth');

        $this->cus = $cus;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(8);
        return view('customers.index', compact('customers'));
    }

    public function select($type)
    {
        $customers = Customer::where('type', $type)->paginate(8);
        return view('customers.index', compact('customers'));
    }

    public function searchCusName(Request $request)
    {
        $customers = Customer::where('name', "like", "%". $request->searchcusname ."%")->paginate(8);
        return view('customers.index', compact('customers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $this->cus->newCustomer($request);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //获得反序列化的合同信息
        $contracts = $this->cus->showContracts($id);
        $cus2s = Customer::findOrFail($id)->customer2s()->orderBy('id','desc')->get();
        return view('customers.show', compact('contracts','id','cus2s'));
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
    public function update(UpdateCustomerRequest $request, $id)
    {
        $this->cus->updateCustomer($request, $id);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function showList($name)
    {
        $companies = Customer::where('name', 'like',"%".$name."%")->select('id', 'name')->limit(10)->get();

        return $companies;
    }

    public function test()
    {
        $time2 = Contract::findOrFail(14)->time2;
        dd($time2);
    }
}
