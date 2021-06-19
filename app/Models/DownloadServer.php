<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DownloadServer
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer query()
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadServer whereUrl($value)
 * @mixin \Eloquent
 */
class DownloadServer extends Model
{
    use HasFactory;
}
