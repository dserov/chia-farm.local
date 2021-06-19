<?php

use App\Models\HostType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('Host name');
            $table->string('ip', 25)->comment('Host ip');
            $table->enum('type', [HostType::NONE_NAME, HostType::PLOT_NAME, HostType::FARM_NAME])->comment('Host type');
            $table->unsignedBigInteger('tmp_free')->default(0);
            $table->unsignedBigInteger('plot_free')->default(0);
            $table->string('description', 255)->comment('Host description')->nullable(true);
            $table->timestamps();
            $table->unique('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts');
    }
}
