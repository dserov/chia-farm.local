<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePlotRequest;
use App\Http\Requests\SaveWalletRequest;
use App\Models\Host;
use App\Models\Order;
use App\Models\PhaseStatus;
use App\Models\Status;
use App\Models\Storage;
use App\Models\Task;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index() {
        $tasks = Task::query()
            ->join('orders', 'orders.id', '=', 'tasks.order_id')
            ->where('orders.user_id', \Auth::id())
            ->where('tasks.phase_status_id', PhaseStatus::MOVED)
            ->get('tasks.*');
        return view('plots.index', [
                'tasks' => $tasks,
            ]);
    }

    public function text(Request $request) {
        $tasks = Task::query()
            ->join('orders', 'orders.id', '=', 'tasks.order_id')
            ->where('orders.user_id', \Auth::id())
            ->where('tasks.phase_status_id', PhaseStatus::MOVED)
            ->get('tasks.*');

        $content = [];
        if (empty($tasks)) {
            $content[] = 'Empty file';
        } else {
            foreach ($tasks as $task) {
                $content[] = $task->link;
            }
        }
        return response()->streamDownload(function () use ($content) {
            echo implode("\r\n", $content);
        }, 'plots.txt');
    }

    public function create(Request $request)
    {
        $userId = \Auth::id();
        // check if order payed
        $orderId = $request->query('order_id');
        Order::where([
                ['id', $orderId],
                ['status_id', Status::PAYED],
                ['user_id', $userId],
            ])->firstOrFail();

        // find wallets
        $wallets = Wallet::where('user_id', $userId)->get();

        //
        return \View::make('plots.new', [
            'orderId' => $orderId,
            'wallets' => $wallets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param SavePlotRequest $request
     *
     * @return string
     */
    public function save(SavePlotRequest $request)
    {
        $order = Order::findOrFail($request->input('order_id'));
        $user = \Auth::user();
        if ($user->cannot('view', $order)) {
            abort(403);
        }

        $wallet = Wallet::findOrFail($request->input('wallet_id'));
        if ($user->cannot('view', $wallet)) {
            abort(403);
        }

        // find max free size in plots on host 95.217.195.36
        $storage = Storage::query()
            ->join('hosts', 'storages.host_id', '=', 'hosts.id')
            ->where('hosts.ip', '95.217.195.36')
            ->orderByDesc('storages.free_size')
            ->limit(1)
            ->first('storages.id');

        try {
            if (is_null($storage)) {
                throw new \Exception('Storage not found');
            }

            $now = Carbon::now()->toDateTimeString();
            $data = [];
            // prepare many insert
            for($i = 1; $i <= $order->plot_amount; $i++) {
                $data[] = [
                    'wallet_id' => $wallet->id,
                    'queue_id' => 100,
                    'storage_id' => $storage->id,
                    'order_id' => $order->id,
                    'created_at' => $now,
                ];
            }

            \DB::transaction(function () use ($data, $order){
                // make tasks
                if (Task::insert($data)) {
                    $order->status_id = Status::PLOT_QUEUED;
                    $order->save();
                }
            });
            return redirect()->route('orders::index')->with(['success' => "Plot queued successfully!"]);
        } catch (\Throwable $throwable) {
            \Log::debug('plot not queued', [$throwable->getMessage()] );
            return back()->with(['error' => 'Plot not queued!'])->withInput();
        }
    }
}
