<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderSaveRequest;
use App\Models\Auction;
use App\Models\DownloadServer;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index() {
        \Session::flash('refresh', 'refresh');
        $orders = Order::where('user_id', \Auth::id())->with(['status'])->get();
        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    public function new($auctionId = null) {
        $download_servers = DownloadServer::query()
            ->select('id', 'name')
            ->get()
            ->pluck('name', 'id');

        $auctions = Auction::query()
            ->select('id', 'price')
            ->get()
            ->pluck('price', 'id');

        return view('orders.new', [
            'auction_max_count' => 1,
            'download_servers' => $download_servers,
            'auctionId' => $auctionId,
            'auctions' => $auctions,
        ]);
    }

    public function save(OrderSaveRequest $request) {
        $auctionId = $request->get('order')['auction_id'];

        $order = new Order();
        $order->fill($request->input('order'));
        $order->user_id = \Auth::id();
        $order->status_id = Status::RESERVED;
        $order->price = Auction::find($auctionId)->price;
        if (!$order->save()) {
            return redirect()
                ->route('orders::new')
                ->withErrors(['Order save error!'])
                ->withInput();
        }

        return redirect()
            ->route('orders::index')
            ->with('success', 'Order created!');
    }

    public function delete(Order $order) {
        try {
            if ($order->delete()) {
                return redirect()
                    ->route('orders::index')
                    ->with('success', 'Order deleted');
            }
            throw new \Exception('Order not deleted!');
        } catch (\Exception $exception) {
            return redirect()->route('orders::index')
                ->withErrors([$exception->getMessage()])
                ->withInput();
        }
    }

    public function show(Order $order) {
        $tasks = $order->tasks()->get();
        return view('orders.show', [
            'order' => $order,
            'tasks' => $tasks,
        ]);
    }

    public function pay(Order $order)
    {
        if ($order->status_id == Status::PAYED) {
            return redirect()->route('orders::index')->with('success', 'Order already payed!');
        }
        $user = \Auth::user();
        $userBalans = $user->balans;
        $orderTotal = $order->price * $order->plot_amount;
        if ($userBalans >= $orderTotal) {
            // spishem user balans
            \DB::transaction(function () use($user, $order) {
                $user->balans -= $order->price * $order->plot_amount;
                $user->save();
                $order->status_id = Status::PAYED;
                $order->save();
            });

            return redirect()->route('orders::index')->with('success', 'Order was payed successfully!');
        }

        return View::make('orders.pay', ['order' => $order]);
    }
}
