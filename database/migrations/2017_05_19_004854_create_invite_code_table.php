<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInviteCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_code', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inviter_id')->default(0)->comment('邀请者ID');
            $table->integer('invitee_id')->default(0)->nullable()->comment('被邀请者ID');
            $table->string('status')->default('created')->comment('状态 created创建,used已使用,obsolete过时了');
            $table->string('code')->comment('邀请码');
            $table->timestamp('obsoleted_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('过时时间');
            $table->timestamps();
            $table->index('inviter_id');
            $table->index('invitee_id');
            $table->index('status');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invite_code');
    }
}
