<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTasksAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table){
            $table->timestamp('issued_at')->nullable()->default(null)->comment('Дата-время выдачи задачи');
            $table->unsignedBigInteger('issued_host_id')->nullable()->default(null)->comment('Какой машине выдано');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table){
            $table->dropColumn('issued_at');
            $table->dropColumn('issued_host_id');
        });
    }
}
