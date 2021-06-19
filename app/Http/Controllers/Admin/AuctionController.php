<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveAuctionRequest;
use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    //
    public function index()
    {
        return \View::make('admin.auction.index', [
            'auctions' => Auction::query()->paginate(10)
        ]);
    }

    public function save(SaveAuctionRequest $request)
    {
        $auction = Auction::updateOrCreate(
            ['id' => $request->input('auction.id')],
            $request->input('auction')
        );

        if ($auction) {
            return redirect()
                ->route('admin::auctions::index')
                ->with('success', 'Auction saved!');
        }

        return redirect()
            ->route('admin::auctions::create')
            ->withErrors(['Not saved!'])
            ->withInput();
    }

    public function delete(Auction $auction)
    {
        try {
            if ($auction->delete()) {
                return redirect()
                    ->route('admin::auctions::index')
                    ->with('success', 'Auction deleted');
            }
            throw new \Exception('Auction not deleted!');
        } catch (\Exception $exception) {
            return redirect()->route('admin::auctions::index')
                ->withErrors([$exception->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, Auction $auction)
    {
        $request->replace([
            'auction' => $auction->toArray(),
        ]);
        $request->flash();
        return $this->create();
    }

    public function create()
    {
        return \View::make('admin.auction.create');
    }
}
