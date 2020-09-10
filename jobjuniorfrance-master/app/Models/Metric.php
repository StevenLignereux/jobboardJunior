<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clicked
 * @property date $day
 */
class Metric extends Model
{

    public $timestamps = false;
    protected $fillable =
    [
        'id',
        'clicked',
        'day'
    ];
}
