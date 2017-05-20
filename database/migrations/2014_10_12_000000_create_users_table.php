<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid')->default('')->comment('加密ID');
            $table->string('name')->comment('用户名');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->integer('github_id')->default(0);
            $table->integer('wechat_id')->default(0);
            $table->integer('weibo_id')->default(0);
            $table->integer('qq_id')->default(0);
            $table->integer('google_id')->default(0);
            $table->integer('douban_id')->default(0);
            $table->integer('topic_count')->default(0)->index();
            $table->integer('reply_count')->default(0)->index();
            $table->integer('follower_count')->default(0)->index();
            $table->string('verified')->default('false')->index();
            $table->enum('email_notify_enabled', ['yes',  'no'])->default('yes')->index();
            $table->string('register_source')->nullable()->index();
            $table->timestamp('last_actived_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->index('hid');


//            $table->increments('id');
//            $table->string('password')->nullable();
//            $table->integer('github_id')->unique()->nullable()->index();
//            $table->string('mobile')->unique()->nullable()->index();
//            $table->string('github_url')->nullable();
//            $table->string('email')->nullable()->index();
//            $table->string('name')->nullable()->index();
//            $table->string('login_token')->nullable();
//            $table->enum('is_banned', ['yes',  'no'])->default('no')->index();
//            $table->string('image_url')->nullable();
////            $table->integer('topic_count')->default(0)->index();
////            $table->integer('reply_count')->default(0)->index();
////            $table->integer('follower_count')->default(0)->index();
//            $table->string('city')->nullable();
//            $table->string('company')->nullable();
//            $table->string('twitter_account')->nullable();
//            $table->string('personal_website')->nullable();
//            $table->string('introduction')->nullable();
//            $table->string('certification')->nullable();
//            $table->integer('notification_count')->default(0);
//            $table->string('github_name')->nullable()->index();
//            $table->string('real_name')->nullable();
//            $table->string('linkedin')->nullable();
//            $table->string('payment_qrcode')->nullable();
//            $table->string('wechat_qrcode')->nullable();
////            $table->string('avatar')->nullable();
//            $table->string('login_qr')->nullable();
//            $table->string('wechat_openid')->nullable()->index();
//            $table->string('wechat_unionid')->nullable()->index();
//            $table->string('weibo_name')->nullable();
//            $table->string('weibo_link')->nullable();
//            $table->string('verification_token')->nullable();
//
//            $table->softDeletes();
//            $table->rememberToken();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
