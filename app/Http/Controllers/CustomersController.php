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
        $customers = Customer::paginate(8);
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
        $contracts = Customer::findOrFail($id)->contracts()->get();
        foreach ($contracts as $contract){
            $contract->pm = unserialize($contract->pm);
            $contract->tm = unserialize( $contract->tm);
        }
        $cus2s = Customer::findOrFail($id)->customer2s()->get();
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

    public function test(Request $request)
    {
        $cus = Contract::findOrFail(14)->customer()->first();
        dump($cus->name);
//        $phpWord = new PhpWord();
//
//        //样式
//        $phpWord->addTitleStyle(1, array('size' => 18,'bold' => true), array('alignment' => Jc::CENTER, 'spaceAfter' => 240));
//        $tableStyle = array('width' => 80 * 50, 'unit' => 'pct', 'borderSize'=>9, 'borderColor' => '000000', 'cellMargin' => 80,'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
//        $tableCellStyle = array('valign' => 'center');
//        $rowH = array('alignment'=>Jc::CENTER);
//        $cellColSpan6 = array( 'gridSpan'=>6, 'valign '=>'center');  //1并6居中
//        $cellColSpan2 = array( 'gridSpan'=>2, 'valign '=>'center');  //1并2居中
//        $cellColSpan5 = array( 'gridSpan'=>5, 'valign '=>'center');  //1并5居中
//        $cellHCentered = array('alignment' => Jc::CENTER);
//
//        $section = $phpWord->addSection();
//        //标题
//        $section->addTitle('南京中网卫星通信股份有限公司', 1);
//        //表格
//        $table = $section->addTable($tableStyle);
//
//        $row = $table->addRow(400);
//        $textrun1 = $row->addCell(12000,$cellColSpan6)->addTextRun($cellHCentered);
//        $textrun1->addText('客服工作任务单', array('bold'=>true, 'size'=>14));
//
//        $row = $table->addRow();
//        $row->addCell(2000)->addText('受理编号');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//        $row->addCell(2000)->addText('受理时间');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//
//        $row = $table->addRow();
//        $row->addCell(2000)->addText('派单人');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//        $row->addCell(2000)->addText('派单时间');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//
//        $row = $table->addRow();
//        $row->addCell(2000)->addText('用户单位名称');
//        $row->addCell(10000,$cellColSpan5)->addText('');
//
//        $row = $table->addRow();
//        $row->addCell(2000)->addText('用户单位地址');
//        $row->addCell(10000,$cellColSpan5)->addText('');
//
//        $row = $table->addRow();
//        $row->addCell(2000)->addText('用户联系人');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//        $row->addCell(2000)->addText('联系方式');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//
//        $row = $table->addRow();
//        $row->addCell(2000)->addText('客户状态');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//        $row->addCell(2000)->addText('服务类型');
//        $row->addCell(4000, $cellColSpan2)->addText('');
//
//        $row = $table->addRow(3750);
//        $row->addCell(2000)->addText('问题描述');
//        $row->addCell(10000, $cellColSpan5)->addText('');
//
//        $row = $table->addRow();
//        $row->addCell(2000)->addText('执行人');
//        $row->addCell(2000)->addText('');
//        $row->addCell(2000)->addText('执行时间');
//        $row->addCell(2000)->addText('');
//        $row->addCell(2000)->addText('预计工时');
//        $row->addCell(2000)->addText('');
//
//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//        header('Content-type: application/word');
//        header('Content-Disposition: attachment; filename="客服工作任务单.docx"');
//        $objWriter->save('php://output');

    }
}
