<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePtPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pt_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');         //兼职类型（接待等）
            $table->string('area');         //兼职工作地区
            $table->text('content');        //兼职信息

            $table->string('name');                     //负责人称呼
            $table->string('wechat')->nullable();        //负责人微信
            $table->string('phone')->nullable();        //负责人电话
            $table->string('email')->nullable();        //负责人邮箱
            $table->string('qq')->nullable();        //负责人qq


            $table->timestamps();           //发布时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pt_posts');
    }
}
