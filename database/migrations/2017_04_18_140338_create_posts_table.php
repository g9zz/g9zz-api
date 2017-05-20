<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid')->unique()->comment('加密ID');
            $table->string('title')->comment('帖子标题');
            $table->text('content')->comment('帖子内容');
            $table->string('source')->nullable()->comment('来源跟踪：iOS，Android')->index();
            $table->integer('user_id')->unsigned()->comment('作者ID')->default(0)->index();
            $table->integer('reply_count')->default(0)->comment('回复数')->index();
            $table->integer('view_count')->unsigned()->comment('查看数')->default(0)->index();
            $table->integer('vote_count')->default(0)->comment('点赞数')->index();
            $table->integer('last_reply_user_id')->unsigned()->comment('最后回复人的ID')->default(0)->index();
            $table->integer('order')->default(0)->index();
            $table->enum('is_top', ['yes',  'no'])->comment('是否置顶')->default('no')->index();
            $table->enum('is_excellent', ['yes',  'no'])->comment('是否加精')->default('no')->index();
            $table->enum('is_blocked', ['yes',  'no'])->comment('是否block')->default('no')->index();
            $table->text('body_original')->comment('原内容')->nullable();
            $table->text('excerpt')->nullable()->comment('摘要');
            $table->enum('is_tagged', ['yes',  'no'])->default('no')->index();
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
        Schema::dropIfExists('posts');
    }
}
