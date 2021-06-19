<?php

namespace Database\Seeders;

use App\Models\HostType;
use Illuminate\Database\Seeder;

class HostTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        HostType::create([
            'id' => HostType::NONE,
            'type' => HostType::NONE_NAME,
        ]);
        HostType::create([
            'id' => HostType::PLOT,
            'type' => HostType::PLOT_NAME,
        ]);
        HostType::create([
            'id' => HostType::FARM,
            'type' => HostType::FARM_NAME,
        ]);
    }
}
