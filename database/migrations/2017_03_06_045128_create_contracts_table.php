<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('contract_id');
            $table->integer('type')->default(0);  //0：销售签，1：客服签
            $table->integer('contract_type')->default(0);  //0：集成、1：服务、2：信道、3：综合
            $table->string('name');  //合同名称
//            $table->integer('active')->default(0); //0:非维保， 1：维保
            $table->string('pm')->nullable();  //项目经理
            $table->string('tm')->nullable();  //技术经理
            $table->decimal('sum',10,2)->nullable();  //金额，精度10，小数位数2
            $table->string('time1')->nullable();  //合同开始日期
            $table->string('time2')->nullable();  //质保结束日期
            $table->string('time3')->nullable(); //验收日期
            $table->text('desc')->nullable(); //项目基本描述
            $table->integer('if_check')->default(0); //是否验收状态字
            $table->string('main_unit')->nullable(); //主要外协单位
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
