<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_service');   //受理编号
            $table->string('time1');    //受理时间
            $table->string('sendman'); //派单人
            $table->string('cus_name');//用户单位名称
            $table->string('cus_addr');//用户单位地址
            $table->string('cus2_name');//用户联系人
            $table->string('cus2_phone'); //联系方式
            $table->string('status');  //客户状态
            $table->string('type');  //服务类型
            $table->text('desc'); //问题描述
            $table->string('servisor'); //服务人员
            $table->string('time2'); //服务时间
            $table->string('time3'); //预计工时
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
        Schema::dropIfExists('service_tasks');
    }
}
