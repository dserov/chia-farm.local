<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('storage_id');
            $table->string('folder', 255);
            $table->unsignedBigInteger('queue_id');
            $table->boolean('is_closed')->default(false);
            $table->timestamps();
            $table->foreign('wallet_id')
                ->on('wallets')
                ->references('id')
                ->restrictOnDelete()
                ->onUpdate('restrict');
            $table->foreign('storage_id')
                ->on('storages')
                ->references('id')
                ->restrictOnDelete()
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
