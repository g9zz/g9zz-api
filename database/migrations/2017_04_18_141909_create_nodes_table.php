<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid')->unique()->comment('加密ID');
            $table->integer('parent_id')->default(0)->comment('父级 id');
            $table->integer('post_count')->default(0)->comment('帖子数');
            $table->tinyInteger('weight')->default(0)->comment('权重');
            $table->tinyInteger('level')->default(0)->comment('等级');
            $table->enum('is_show', ['yes',  'no'])->default('no')->index();
            $table->string('name')->index()->comment('名称');
            $table->string('slug', 60)->unique()->comment('缩略名');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('nodes');
    }
}
