<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Host;
use App\Models\Storage;
use Illuminate\Http\Request;
use Log;

class HostController extends Controller
{
    //

    public function show(string $ip)
    {
        $host = Host::where('ip', $ip)->firstOrFail();
        return response()->json($host, 200);
    }

    public function update(string $ip)
    {
        $host = Host::query()->with('storages')->firstOrCreate(
            [
                'ip' => $ip,
            ],
            [
                'type' => 'none',
                'name' => $ip,
                'ip' => $ip,
                'tmp_free' => 0,
                'plot_free' => 0,
                'plots_count' => 0,
            ]);

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (isset($data['tmp_free'])) {
            $host->tmp_free = intval($data['tmp_free']);
        }
        if (isset($data['plots_count'])) {
            $host->plots_count = max(0, intval($data['plots_count']));
        }
        if (isset($data['plot_free'])) {
            $host->plot_free = intval($data['plot_free']);
        }
        $host->save();

        $newStorages = @$data['storages'];
        if (is_null($newStorages) || !is_array($newStorages)) {
            return response()->json($host, 200);
        }

        // process storage list
        foreach ($host->storages as $storage) {
            if (!array_key_exists($storage->path, $newStorages)) {
                $storage->delete();
            }
        }

        foreach ($newStorages as $path => $free) {
            Storage::updateOrCreate(
                [
                    'path' => $path,
                    'host_id' => $host->id,
                ],
                [
                    'path' => $path,
                    'free_size' => intval($free),
                    'host_id' => $host->id,
                ]
            );
        }

        $host->refresh();
        return response()->json($host, 200);
    }
}
