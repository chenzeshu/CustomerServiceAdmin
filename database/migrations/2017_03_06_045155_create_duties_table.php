<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');     //对应外键员工表的id
//            $table->integer('contract_id'); //外应外键合同表的id  不需要，直接hasManyThrough，所以本表的外键都是直接上级表的id
            $table->integer('service_id'); //对应外键服务表的id
            $table->string('duty');  //职责
            //...
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
        Schema::dropIfExists('duties');
    }
}
