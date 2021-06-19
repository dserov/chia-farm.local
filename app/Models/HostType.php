<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HostType
 *
 * @property int $id
 * @property string $type Host type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Host[] $hosts
 * @property-read int|null $hosts_count
 * @method static \Illuminate\Database\Eloquent\Builder|HostType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HostType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HostType query()
 * @method static \Illuminate\Database\Eloquent\Builder|HostType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HostType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HostType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HostType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HostType extends Model
{
    use HasFactory;

    const NONE = 1;
    const PLOT = 2;
    const FARM = 3;

    const NONE_NAME = 'none';
    const PLOT_NAME = 'plot';
    const FARM_NAME = 'farm';

//    public function hosts()
//    {
//        return $this->hasMany(Host::class);
//    }
}
