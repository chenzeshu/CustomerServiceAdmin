<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 18:46
 */

namespace App\Repositories;

use App\Contract;
use App\Customer2;
use App\Service;
use App\ServiceTask;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;

class ServicesRepository
{

    public function newService($request)
    {
        $info = Service::orderBy('id','desc')->limit(1)->pluck('s_id');
        $number = substr($info[0], 0, 8);
        $date = date('Ymd');

        if ($number == $date){
            //假如今天是同一天
            $s_id = $info[0]+1;
            $s_id2 = $this->typeToId($s_id, $request->type);
        }else{
            //假如今天是新的一天
            $s_id = $date.'001';
            $s_id2 = $this->typeToId($s_id, $request->type);
        }
        $serviser = $request->serviser;
        $customer2 = $request->customer2;
        $visitor = $request->visitor;
        Service::create([
            's_id'=> $s_id,
            's_id2'=> $s_id2,
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
//            's_id'=> 20170303,
//            's_id2'=>20170303,
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

    public function typeToId($id,$type)
    {
        switch ($type){
            case "0":
                return $id.'GZ';
                break;
            case "1":
                return $id.'XJ';
                break;
            case "2":
                return $id.'BZ';
                break;
            case "3":
                return $id.'YC';
                break;
            case "4":
                return $id.'QT';
                break;
            default:
                break;
        }
    }

    public function createServiceTask($request)
    {
        $con = Contract::findOrFail($request->contract_id);
        $cus = Contract::findOrFail($request->contract_id)->customer()->first();
        $cus2 = Customer2::findOrFail($request->customer2[0]['id'])->first();
        ServiceTask::create([
            'id_service'=>$request->s_id2,
            'time1'=>$request->time1,
            'sendman'=>Auth::user()->name,
            'cus_name'=>$cus->name,
            'cus_addr'=>$cus->addr,
            'cus2_name'=>$cus2->name,
            'cus2_phone'=>$cus2->phone,
            'status'=>toStatus($con->type),
            'type'=>toType($request->type),
            'desc'=>$request->desc1,
            'servisor'=> serialize($request->serviser),
            'time2'=>$request->time2,
            'time3'=>$request->time4
            ]);
    }

    public function printServiceTask()
    {
        $data = ServiceTask::orderBy('id','desc')->first();
        $data->servisor = unserialize($data->servisor);
        $phpWord = new PhpWord();

        //样式
        $phpWord->addTitleStyle(1, array('size' => 18,'bold' => true), array('alignment' => Jc::CENTER, 'spaceAfter' => 240));
        $tableStyle = array('width' => 80 * 50, 'unit' => 'pct', 'borderSize'=>9, 'borderColor' => '000000', 'cellMargin' => 80,'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $tableCellStyle = array('valign' => 'center');
        $rowH = array('alignment'=>Jc::CENTER);
        $cellColSpan6 = array( 'gridSpan'=>6, 'valign '=>'center');  //1并6居中
        $cellColSpan2 = array( 'gridSpan'=>2, 'valign '=>'center');  //1并2居中
        $cellColSpan5 = array( 'gridSpan'=>5, 'valign '=>'center');  //1并5居中
        $cellHCentered = array('alignment' => Jc::CENTER);

        $section = $phpWord->addSection();

        $section->addImage(public_path('/img/logo.png'),array(
            'positioning' => 'relative',
            'marginLeft' => "578.32",
            'marginTop' => "1.23",
            'width'         => 60,
            'height'        => 60,
            'wrappingStyle' => 'behind',
        ));
        //标题
        $section->addTitle('南京中网卫星通信股份有限公司', 1);
        //表格
        $table = $section->addTable($tableStyle);

        $row = $table->addRow(400);
        $textrun1 = $row->addCell(12000,$cellColSpan6)->addTextRun($cellHCentered);
        $textrun1->addText('客服工作任务单', array('bold'=>true, 'size'=>14));

        $row = $table->addRow();
        $row->addCell(2000)->addText('受理编号');
        $row->addCell(4000, $cellColSpan2)->addText($data->id_service);
        $row->addCell(2000)->addText('受理时间');
        $row->addCell(4000, $cellColSpan2)->addText($data->time1);

        $row = $table->addRow();
        $row->addCell(2000)->addText('派单人');
        $row->addCell(4000, $cellColSpan2)->addText($data->sendman);
        $row->addCell(2000)->addText('派单时间');
        $row->addCell(4000, $cellColSpan2)->addText($data->updated_at);

        $row = $table->addRow();
        $row->addCell(2000)->addText('用户单位名称');
        $row->addCell(10000,$cellColSpan5)->addText($data->cus_name);

        $row = $table->addRow();
        $row->addCell(2000)->addText('用户单位地址');
        $row->addCell(10000,$cellColSpan5)->addText($data->cus_addr);

        $row = $table->addRow();
        $row->addCell(2000)->addText('用户联系人');
        $row->addCell(4000, $cellColSpan2)->addText($data->cus2_name);
        $row->addCell(2000)->addText('联系方式');
        $row->addCell(4000, $cellColSpan2)->addText($data->cus2_phone);

        $row = $table->addRow();
        $row->addCell(2000)->addText('客户状态');
        $row->addCell(4000, $cellColSpan2)->addText($data->status);
        $row->addCell(2000)->addText('服务类型');
        $row->addCell(4000, $cellColSpan2)->addText($data->type);

        $row = $table->addRow(3750);
        $row->addCell(2000)->addText('问题描述');
        $row->addCell(10000, $cellColSpan5)->addText($data->desc);

        $row = $table->addRow();
        $row->addCell(2000)->addText('执行人');
        $text = $row->addCell(2000);
        foreach ($data->servisor as $single){
            $text->addText($single['name']);
        }

        $row->addCell(2000)->addText('执行时间');
        $row->addCell(2000)->addText($data->time2);
        $row->addCell(2000)->addText('预计工时(天数)');
        $row->addCell(2000)->addText($data->time3*0.5);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        header('Content-type: application/word');
        header('Content-Disposition: attachment; filename="客服工作任务单.docx"');
        $objWriter->save('php://output');
    }
}