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
            $table->string('name');  //合同名称
            $table->integer('active')->default(0);
            $table->string('pm')->nullable();  //项目经理
            $table->string('tm')->nullable();  //技术经理
            $table->decimal('sum',10,2)->nullable();  //金额，精度10，小数位数2
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
