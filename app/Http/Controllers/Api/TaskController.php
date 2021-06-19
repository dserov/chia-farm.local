<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Host;
use App\Models\PhaseStatus;
use App\Models\Status;
use App\Models\Storage;
use App\Models\Task;
use App\Models\User;
use App\Notifications\CopyingPlotError;
use App\Notifications\TaskAndOrderNotSynced;
use Illuminate\Http\Request;
use Str;

class TaskController extends Controller
{
    public function getTask(Request $request, string $ip)
    {
        $host = Host::query()->where('ip', $ip)->firstOrFail();

        $queue_id = intval($request->query('queue_id'));
        $task = Task::query()->where([
                ['queue_id', $queue_id],
                ['is_closed', false],
            ])
            ->orderBy('id')
            ->with(['wallet', 'storage.host'])->first();
        if (is_null($task)) {
            return response()->json($task, 200);
        }

        $task->issued_at = now();
        $task->issued_host_id = $host->id;
        $task->is_closed = true;
        $task->save();
        $response = [
            'task_id' => $task->id,
            'folder' => '/' . $task->storage->path,
            'ip' => $task->storage->host->ip,
            'master_key' => $task->wallet->master_key,
            'farmer_key' => $task->wallet->farmer_key,
            'pool_key' => $task->wallet->pool_key,
        ];
        return response()->json($response, 200);
    }

    public function log(Task $task)
    {
        $data = file_get_contents('php://input');
        $lines = explode("\n", $data);

        \Log::debug($data);

        foreach ($lines as $line) {
            if(Str::startsWith($line, 'Caught plotting error')) {
                if ($task->last_error != $line) {
                    $task->last_error = $line;
                    $this->sendNotification($task, 'Caught plotting error');
                }
            }

            if(Str::startsWith($line, 'Time for phase')) {
                $value = Str::between($line, 'Time for phase', '=');
                $value = intval((string) Str::of($value)->trim());
                $task->phase_status_id = $value;
            }

            if(Str::startsWith($line, 'NETWORK ERROR!')) {
                if ($task->last_error != 'Network error') {
                    $task->last_error = 'Network error';
                    $this->sendNotification($task, 'Network error');
                }
            }

            if(Str::startsWith($line, 'Moved successfully')) {
                $parts = explode(',', $line);
                if (count($parts) === 3) {
                    [, $ip, $link] = $parts;
                    $task->phase_status_id = PhaseStatus::MOVED;
                    $task->last_error = null;
                    $task->link = $this->makeLink($ip, $link);
                    $task->save();
                    if ($task->order_id) {
                        $this->updateOrder($task);
                    }
                }
            }
        }

        $task->save();
        return response()->json(['success' => 'OK']);
    }

    // update order status if all task completed
    public function updateOrder(Task $task)
    {
        $order = $task->order;
        $order->plot_completed++;
        if ($order->plot_amount == $order->plot_completed) {
            $order->status_id = Status::PLOT_READY;
        }
        $order->save();

        // check for error
        $inCompletedTasks = Task::where('phase_status_id', '<>', PhaseStatus::MOVED)
            ->where('order_id', $task->order_id)->count();
        if ($inCompletedTasks > 0 && $order->status_id == Status::PLOT_READY) {
            $users = User::where('is_admin', true)->get();
            \Notification::send($users, new TaskAndOrderNotSynced($task));
        }
    }

    public function sendNotification(Task $task, $message) {
        $users = User::where('is_admin', true)->get();
        \Notification::send($users, new CopyingPlotError($task, $message));
    }

    /**
     * @param $ip
     * @param $link
     * @return string
     */
    public function makeLink($ip, $link) {
        $ip = (string) Str::of($ip)->trim();
        $link = (string) Str::of($link)->trim();
        $link = str_replace('//', '/', $link);
        [, $ftpLogin ] = explode('/', $link);
        $ftpPassword = env('FTP_USER_PASSWORD', '');
        if ($ftpPassword) {
            return sprintf('ftp://%s:%s@%s%s', $ftpLogin, $ftpPassword, $ip, $link);
        }
        return sprintf('ftp://%s@%s%s', $ftpLogin, $ip, $link);
    }
}
