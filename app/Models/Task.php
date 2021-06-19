<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $wallet_id
 * @property int $storage_id
 * @property string $folder
 * @property int $queue_id
 * @property int $is_closed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Storage $storage
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Wallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereIsClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereQueueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereWalletId($value)
 * @mixin \Eloquent
 * @property string|null $issued_at Дата-время выдачи задачи
 * @property int|null $issued_host_id Какой машине выдано
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereIssuedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereIssuedHostId($value)
 * @property int|null $phase_status_id
 * @property string|null $link
 * @property int|null $order_id
 * @property-read \App\Models\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePhaseStatusId($value)
 * @property-read \App\Models\Host $host
 * @property string|null $last_error
 * @property-read \App\Models\Host|null $issued_host
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereLastError($value)
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'storage_id',
        'queue_id',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function storage() {
        return $this->belongsTo(Storage::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function issued_host() {
        return $this->belongsTo(Host::class);
    }
}
