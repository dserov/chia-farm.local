<?php

namespace App\Listeners;

use App\Events\OrderWasPayed;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use function Psy\debug;

class AddingBonusToReferral
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderWasPayed  $event
     * @return void
     */
    public function handle(OrderWasPayed $event)
    {
        $order = $event->order;

        $user = User::find($order->user_id);
        if (is_null($user)) {
            return;
        }

        $referral = $user->referral;

        if (is_null($referral)) {
            return;
        }

        $bonusPercent = config('referral.bonus_percent', 10);
        $referral->balans += ($order->price * $order->plot_amount * $bonusPercent) / 100;
        $referral->save();
    }
}
