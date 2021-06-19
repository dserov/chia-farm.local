<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTaskRequest;
use App\Models\Host;
use App\Models\Storage;
use App\Models\Task;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index()
    {
        return \View::make('admin.task.index', [
            'tasks' => Task::query()->orderByDesc('id')->with(['wallet', 'storage', 'issued_host'])->paginate(100)
        ]);
    }

    public function show(Task $task)
    {
        return \View::make('admin.task.show', [
            'task' => $task
        ]);
    }

    public function delete(Task $task)
    {
        try {
            if ($task->delete()) {
                return redirect()
                    ->route('admin::tasks::index')
                    ->with('success', 'Task deleted');
            }
            throw new \Exception('Task not deleted!');
        } catch (\Exception $exception) {
            return redirect()->route('admin::tasks::index')
                ->withErrors([$exception->getMessage()])
                ->withInput();
        }
    }

    public function create()
    {
        return \View::make('admin.task.create', [
            'wallets' => Wallet::query()->with(['user'])->get(),
        ]);
    }

    public function save(SaveTaskRequest $request)
    {
        $data = $request->validated();

        for( $i = 0; $i < $data['tasks_count']; $i++ ) {
            Task::create($data);
        }

        return redirect()
            ->route('admin::tasks::index');
    }

    public function index_old() {
        $rows = \DB::select("SELECT GROUP_CONCAT(ttt.is_closed_count) AS progress, GROUP_CONCAT(ttt.is_closed) AS closed, ttt.storage_id AS storage_id, s.path, w.id as wallet_id, w.name as wallet_name, h.name as host_name, ttt.queue_id
            from
            (SELECT count(*) AS is_closed_count, t.storage_id, t.wallet_id, t.is_closed, t.queue_id FROM tasks t
            GROUP BY t.storage_id, t.is_closed, t.wallet_id, t.queue_id
            ) AS ttt
            INNER JOIN wallets w ON w.id = ttt.wallet_id
            INNER JOIN storages s ON s.id = ttt.storage_id
            INNER JOIN hosts h ON h.id = s.host_id
            GROUP BY ttt.storage_id, ttt.wallet_id, ttt.storage_id, s.path, w.id, w.name, h.name, ttt.queue_id;");

        $tasks = [];
        foreach ($rows as $row) {
            $parts = explode(',', $row->progress);
            if (count($parts) == 1 && $row->closed == '1') {
                continue;
            }
            if (count($parts) < 2) {
                array_push($parts, 0);
            }
            $tasks[] = [
                'queue_id' => $row->queue_id,
                'storage_id' => $row->storage_id,
                'current' => $parts[1], // закрыто
                'total' => $parts[0] + $parts[1], // всего
                'wallet_id' => $row->wallet_id,
                'wallet_name' => $row->wallet_name,
                'storage_path' => $row->path,
                'host_name' => $row->host_name,
            ];
        }

        return \View::make('admin.task.index', [
            'tasks' => $tasks,
        ]);
    }

    public function indexJson(Request $request)
    {
        $wallet_id = intval($request->input('wallet_id'));
        $storage_id = intval($request->input('storage_id'));

        $rows = \DB::table('tasks')
            ->leftJoin('hosts','hosts.id','=','tasks.issued_host_id')
            ->where('tasks.wallet_id', $wallet_id)
            ->where('tasks.storage_id', $storage_id)
            ->select('tasks.id', 'tasks.is_closed', 'hosts.name as host_name', 'tasks.issued_at', 'tasks.phase_status_id')
            ->get();
        return response()->json( ['data' => $rows]);
    }

    public function manyDelete(Request $request)
    {
        try {
            $wallet_id = $request->input('wallet_id');
            $storage_id = $request->input('storage_id');
            $queue_id = $request->input('queue_id');
            Task::where('storage_id', $storage_id)
                ->where('wallet_id', $wallet_id)
                ->where('queue_id', $queue_id)
                ->where('is_closed', 0)
                ->delete();

            response()->json([]);
        } catch (\Exception $exception) {
            response()->json([], 400);
        }
    }
}
