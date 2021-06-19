<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveHostRequest;
use App\Models\Host;
use App\Models\HostType;
use App\Models\Wallet;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    //
    public function index()
    {
        return \View::make('admin.host.index', [
            'hosts' => Host::query()->with('storages')->paginate(10)
        ]);
    }

    public function indexJson(Request $request)
    {
        $wallet_id = $request->input('wallet_id', '');
        if (empty($wallet_id)) {
            return response()->json(['hosts' => Host::all()]);
        }

        return response()->json([
            'hosts' => Host::where('wallet_id', $wallet_id)->get()
        ]);
    }

    public function save(SaveHostRequest $request)
    {
        $host = Host::updateOrCreate(
            ['id' => $request->input('host.id')],
            $request->input('host')
        );

        if ($host) {
            return redirect()
                ->route('admin::hosts::index')
                ->with('success', 'Host saved!');
        }

        return redirect()
            ->route('admin::hosts::create')
            ->withErrors(['Not saved!'])
            ->withInput();
    }

    public function delete(Host $host)
    {
        try {
            if ($host->delete()) {
                return redirect()
                    ->route('admin::host::index')
                    ->with('success', 'Host deleted');
            }
            throw new \Exception('Host not deleted!');
        } catch (\Exception $exception) {
            return redirect()->route('admin::hosts::index')
                ->withErrors([$exception->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, Host $host)
    {
        $request->replace([
            'host' => $host->toArray(),
        ]);
        $request->flash();
        return $this->create();
    }

    public function create()
    {
        $wallets = Wallet::all();
        return \View::make('admin.host.create', [
            'hostTypes' => HostType::select('type')->get()->pluck('type'),
            'wallets' => $wallets,
        ]);
    }
}
