<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGithubUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('github_id')->default(0)->comment('github的ID');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('name')->nullable()->comment('用户名');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('avatar')->nullable()->comment('头像');
            $table->integer('gravatar_id')->default(0);
            $table->string('url')->nullable()->comment('github的api地址');
            $table->string('html_url')->nullable()->comment('github地址');
            $table->string('type')->nullable()->default('user')->comment('类型');
            $table->string('site_admin')->nullable()->default('false');
            $table->string('company')->nullable()->default('');
            $table->string('blog')->nullable()->default('');
            $table->string('location')->nullable()->default('');
            $table->string('hireable')->nullable()->default('');
            $table->string('bio')->nullable()->default('');
            $table->integer('public_repos')->nullable()->default(0);
            $table->integer('public_gists')->nullable()->default(0);
            $table->integer('followers')->nullable()->default(0);
            $table->string('github_created_at')->nullable()->default('');
            $table->string('github_updated_at')->nullable()->default('');
            $table->timestamps();
            $table->index('email');
            $table->index('name');
            $table->index('nickname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('github_user');
    }
}
