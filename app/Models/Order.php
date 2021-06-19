<?php

namespace App\Models;

use App\Events\OrderWasPayed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $auction_id
 * @property int $download_server_id
 * @property int $wallet_id
 * @property int $plot_amount
 * @property int $status_id
 * @property float $price Сумма заказа
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAuctionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDownloadServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePlotAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereWalletId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Status $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property int $plot_completed
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePlotCompleted($value)
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'plot_amount',
        'download_server_id',
        'auction_id',
        'status_id',
    ];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected static function booted()
    {
        static::updating(function (Order $order) {
            if ($order->isDirty('status_id') && $order->status_id == Status::PAYED) {
                event(new OrderWasPayed($order));
            }
        });
    }
}
