<?php

namespace App\Http\Controllers;

use App\Models\Auction;

class IndexController extends Controller
{
    //
    public function index() {
        $auctions = Auction::all();
        return view('index', [
            'auctions' => $auctions
        ]);
    }
}
