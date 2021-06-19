<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PhaseStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseStatus query()
 * @mixin \Eloquent
 */
class PhaseStatus extends Model
{
    use HasFactory;

    const PHASE1 = 1;
    const PHASE2 = 2;
    const PHASE3 = 3;
    const PHASE4 = 4;
    const MOVED = 5;
}
