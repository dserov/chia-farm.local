<?php

namespace Database\Seeders;

use App\Models\Host;
use App\Models\HostType;
use Illuminate\Database\Seeder;

class HostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Антон Заикин, [08.05.21 17:56]
        //88.99.56.223 - plot
        //152.228.250.49 -farm
        //152.228.250.142 -farm
        //152.228.250.143 -farm
        //152.228.250.140 -farm
        //152.228.250.144 -farm
        //152.228.250.145 -farm
        //152.228.250.141 -farm
        //65.21.40.24 -plot
        //65.21.40.32 -plot
        //54.37.31.202 -farm
        //
        //Антон Заикин, [08.05.21 17:57]
        //95.217.195.36 - plot

        Host::create([
            'ip' => '152.228.250.49',
            'name' => '152.228.250.49',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '152.228.250.142',
            'name' => '152.228.250.142',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '152.228.250.143',
            'name' => '152.228.250.143',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '152.228.250.140',
            'name' => '152.228.250.140',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '152.228.250.144',
            'name' => '152.228.250.144',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '152.228.250.145',
            'name' => '152.228.250.145',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '152.228.250.141',
            'name' => '152.228.250.141',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '54.37.31.202',
            'name' => '54.37.31.202',
            'type' => HostType::FARM_NAME,
        ]);
        Host::create([
            'ip' => '88.99.56.223',
            'name' => '88.99.56.223',
            'type' => HostType::PLOT_NAME,
        ]);
        Host::create([
            'ip' => '65.21.40.24',
            'name' => '65.21.40.24',
            'type' => HostType::PLOT_NAME,
        ]);
        Host::create([
            'ip' => '65.21.40.32',
            'name' => '65.21.40.32',
            'type' => HostType::PLOT_NAME,
        ]);
        Host::create([
            'ip' => '95.217.195.36',
            'name' => '95.217.195.36',
            'type' => HostType::PLOT_NAME,
        ]);
    }
}
