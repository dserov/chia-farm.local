<?php

namespace App\Http\Controllers;

use App\Models\DownloadServer;
use Illuminate\Http\Request;

class SpeedtestController extends Controller
{
    //
    public function index() {
        $download_servers = DownloadServer::query()
            ->select('url', 'name')
            ->get()
            ->pluck('name', 'url');
        return view('speedtest.index', [ 'download_servers' => $download_servers]);
    }
}
