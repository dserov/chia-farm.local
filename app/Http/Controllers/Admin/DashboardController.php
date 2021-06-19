<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return \View::make('admin.dashboard.index');
    }

    public function __construct()
    {
        $this->middleware('auth.admin');
    }
}
