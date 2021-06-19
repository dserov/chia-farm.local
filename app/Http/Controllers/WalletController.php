<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveWalletRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Monolog\Logger;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return \View::make('wallet.index', [
            'wallets' => Wallet::where('user_id', \Auth::id())->get()
        ]);
    }

    public function update(Request $request, wallet $wallet)
    {
        //
        $request->replace(['wallet' => $wallet->toArray()])
            ->flash();
        return $this->create();
    }

    public function create()
    {
        //
        return \View::make('wallet.update');
    }


    /**
     * Store a newly created resource in storage.
     * @param SaveWalletRequest $request
     *
     * @return string
     */
    public function save(SaveWalletRequest $request)
    {
        $data = $request->input('wallet');
        $data['user_id'] = \Auth::id();

        $wallet = Wallet::updateOrCreate([
            'id' => $data['id']
        ],
            $data
        );

        // insert or update news
        if (is_null($wallet)) {
            return redirect()->route('wallet::create')->with(['error' => 'Wallet not saved!'])->withInput();
        }

        $action = $data['id'] ? 'updated' : 'created';
        return redirect()->route('wallet::index')->with(['success' => "Wallet {$action} successfully!"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function delete(wallet $wallet)
    {
        try {
            if ($wallet->delete()) {
                return back()->with(['success' => 'Wallet deleted succesfully!']);
            }
            throw new \Exception('Wallet not deleted!');
        } catch (\Exception $exception) {
            return back()
                ->with(['error' => $exception->getMessage()]);
        }

    }
}
