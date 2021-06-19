<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getById($orderId)
    {
        $order = Order::where('id', $orderId)->firstOrFail();
        return response()->json($order);
    }

    public function update($orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->firstOrFail();
        $order->fill($request->only(['status_id']));
        $order->save();
        return response()->json(['status' => 'OK']);
    }

    public function pay($orderId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->status_id == Status::PAYED) {
            return response()->json(['status' => 'OK']);
        }
        $user = User::findOrFail($order->user_id);
        \DB::transaction(function () use($user, $order) {
            $order->status_id = Status::PAYED;
            $order->save();
            if ($user->balans > 0) {
                $user->balans -= min($user->balans, $order->price * $order->plot_amount);
                $user->save();
            }
        });
        return response()->json(['status' => 'OK']);
    }
}
