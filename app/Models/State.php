<?php

namespace App\Models;

use App\Interfaces\IState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    public $fillable = [
        'name',
    ];

    public function counties() : HasMany {
        return $this->hasMany(County::class, 'state_id', 'id');
    }
}
