<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property bool $has_cancelled
 * @property date $created_at
 * @property date $updated_at
 * @property string $parrain
 * @property string $token
 */
class Junior extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['email', 'has_cancelled', 'created_at', 'updated_at', 'parrain', 'token'];
}
