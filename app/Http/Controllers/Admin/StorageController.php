<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function indexJson(Request $request)
    {
        $host_id = $request->get('host_id', null);
        if (is_null($host_id)) {
            return response()->json([ 'storages' => Storage::all()]);
        }
        return response()->json([ 'storages' => Storage::where('host_id', $host_id)->get()]);
    }
}
