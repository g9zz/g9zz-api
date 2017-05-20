<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid')->unique()->comment('加密ID');
            $table->string('source')->nullable()->index()->comment('来源跟踪：iOS，Android');
            $table->integer('post_id')->unsigned()->default(0)->index()->comment('帖子ID');
            $table->integer('user_id')->unsigned()->default(0)->index()->comment('用户ID');
            $table->enum('is_blocked', ['yes',  'no'])->default('no')->index()->comment('是否block');
            $table->integer('vote_count')->default(0)->index()->comment('投票数');
            $table->text('body')->comment('回复内容');
            $table->text('body_original')->nullable()->comment('回复原文');
            $table->softDeletes();
            $table->timestamps();
            $table->index('hid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
