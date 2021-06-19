<?php

namespace App\Http\Controllers;

use App\Models\PhaseStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $plotsGeneratedCount = Task::query()
            ->join('orders', 'orders.id', '=', 'tasks.order_id')
            ->where('orders.user_id', \Auth::id())
            ->where('tasks.phase_status_id', '<=', PhaseStatus::MOVED)
            ->count('tasks.id');
        $plotsGeneratedSize = $plotsGeneratedCount * 102 * 1024 * 1024 * 1024;
        $plotsReadyForDownload = Task::query()
            ->join('orders', 'orders.id', '=', 'tasks.order_id')
            ->where('orders.user_id', \Auth::id())
            ->where('tasks.phase_status_id', '=', PhaseStatus::MOVED)
            ->count('tasks.id');
        $averagePlotPrice = \DB::selectOne('select avg(`orders`.`price`/`orders`.`plot_amount`) as `cost` from `tasks` inner join `orders` on `orders`.`id` = `tasks`.`order_id` where `orders`.`user_id` = ? and `tasks`.`phase_status_id` <= ?',
            [
                \Auth::id(),
                PhaseStatus::MOVED,
            ]);

        $referralUsersCount = \Auth::user()->referrals->count();
        $referralBalans = \Auth::user()->balans;

        return view('dashboard.index', [
            'plotsGeneratedCount' => $plotsGeneratedCount,
            'plotsGeneratedSize' => \App\Helpers\HumanReadable::bytesToHuman($plotsGeneratedSize),
            'plotsReadyForDownload' => $plotsReadyForDownload,
            'averageCostPlot' => $averagePlotPrice->cost,
            'referralUsersCount' => $referralUsersCount,
            'referralBalans' => $referralBalans,
        ]);
    }
}
