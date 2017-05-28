<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpDemands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_demands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school');       //最大15
            $table->string('area');         //最大10
            $table->string('type');         //最大10
            $table->string('time');         //最大15
            $table->text('content');        //最大200

            //个人信息
            $table->string('name');
            $table->string('wechat')->nullable();       //20
            $table->string('phone')->nullable();        //11
            $table->string('email')->nullable();        //30
            $table->string('qq')->nullable();           //15   


            $table->string('userName');     //最大15字符
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
        Schema::dropIfExists('sp_demands');
    }
}
