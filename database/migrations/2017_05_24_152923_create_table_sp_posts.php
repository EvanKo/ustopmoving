<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school');       //想要赞助的赞助学校
            $table->string('area');         //想要赞助的地区
            $table->string('type');     //赞助类型：讲座，摊位，物资等
            $table->text('content');      //主要内容（赞助要求等）


            $table->string('name');     //负责人称呼
            //以下三种方式最少选一种
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
        Schema::dropIfExists('sp_posts');
    }
}
