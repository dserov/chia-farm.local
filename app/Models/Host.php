<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Host
 *
 * @property int $id
 * @property string $name Host name
 * @property string $ip Host ip
 * @property int $host_type_id
 * @property string|null $description Host description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HostType $host_types
 * @method static \Illuminate\Database\Eloquent\Builder|Host newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Host newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Host query()
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereHostTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $type Host type
 * @property int $tmp_free
 * @property int $plot_free
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Storage[] $storages
 * @property-read int|null $storages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Host wherePlotFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereTmpFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereType($value)
 * @property int $plots_count
 * @method static \Illuminate\Database\Eloquent\Builder|Host wherePlotsCount($value)
 * @property int|null $wallet_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\Wallet|null $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|Host whereWalletId($value)
 */
class Host extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'ip',
        'type',
        'plots_count',
        'wallet_id',
    ];

//    public function host_types()
//    {
//        return $this->belongsTo(HostType::class);
//    }

    public function storages()
    {
        return $this->hasMany(Storage::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

