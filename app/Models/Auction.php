<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Auction
 *
 * @property int $id
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Auction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Auction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Auction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
    ];
}
