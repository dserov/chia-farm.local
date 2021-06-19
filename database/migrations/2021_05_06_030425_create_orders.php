<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('auction_id');
            $table->unsignedBigInteger('download_server_id');
            $table->unsignedBigInteger('wallet_id')->nullable(true);
            $table->integer('plot_amount', false, true);
            $table->unsignedBigInteger('status_id');
            $table->unsignedDouble('price')->comment('Сумма заказа')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('download_server_id')
                ->references('id')
                ->on('download_servers')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('auction_id')
                ->references('id')
                ->on('auctions')
                ->onDelete('restrict')
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
        Schema::dropIfExists('orders');
    }
}
