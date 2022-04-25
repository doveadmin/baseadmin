<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('doveadmin_admins_log')) {
            Schema::Create('doveadmin_admins_log', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('admin_id')->default(0)->comment('管理员ID');
                $table->string('operation',255)->nullable()->default(null)->comment('用户操作');
                $table->string('ip',255)->nullable()->default(null);
                $table->softDeletes();//软删除
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doveadmin_admins_log');
    }
}
