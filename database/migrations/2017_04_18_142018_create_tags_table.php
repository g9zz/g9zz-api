<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid')->default('')->comment('加密ID');
            $table->string('name')->comment('标签名(英文)');
            $table->string('display_name')->comment('标签名(汉字)');
            $table->string('description')->nullable()->comment('描述');
            $table->integer('post_count')->default(0)->comment('帖子数');
            $table->tinyInteger('weight')->default(0)->comment('权重');
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
        Schema::dropIfExists('tags');
    }
}
