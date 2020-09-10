<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $info
 * @property date $created_at
 * @property date $updated_at
 */
class Log extends Model
{
    protected $fillable = ['info', 'created_at', 'updated_at'];
}
