<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('s_id'); //内部受理编号
            $table->string('s_id2'); //服务编号
            $table->string('source')->nullable(); //信息来源
            $table->integer('type')->default(0);  //服务类型  0:故障处理、1:巡检、2:应急保障、3:远程协助、4:其他
            $table->text('desc1')->nullable();  //问题描述
            $table->string('serviser'); //服务人员 做成数组[a,b,c] IO时需要转换类似localStorage
            $table->boolean('charge_if')->default(false); //是否收费
            $table->string('customer2')->nullable();    //联系人姓名
            $table->integer('customer2_id')->nullable(); //联系人id
            $table->string('time1')->nullable();//受理时间
            $table->string('time2')->nullable();//解决时间
            $table->string('time3')->nullable();//回访时间
            $table->text('desc2')->nullable(); //处理描述
            $table->integer('result_deal')->default(0); //处理结果 0：待解决，1：已解决，2：待解决
            $table->text('remark')->nullable(); //备注（派生）
            $table->integer('rating')->default(4); //评价：0：非常满意，1：满意，2：一般，3：不满意，4：未评价
            $table->string('vistor')->nullable(); //回访人员
            $table->integer('result_visit')->default(4); //回访结果 0：非常满意，1：满意，2：一般，3：不满意，4：未回访
            $table->integer('time4')->nullable(); //占用工时单位0.5天
            $table->string('files')->nullable(); //数组
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
