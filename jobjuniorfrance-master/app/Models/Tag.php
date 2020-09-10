<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */

class Tag extends Model
{
    protected $fillable = ['name'];
    /**
     * The jobs associated with the tag.
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job');
    }
}
