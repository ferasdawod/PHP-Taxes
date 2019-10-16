<?php

namespace App\Models;

use App\Interfaces\IState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class State extends Model
{
    public $fillable = [
        'name',
    ];

    public function counties() : HasMany {
        return $this->hasMany(County::class, 'state_id', 'id');
    }

    public function entries() : HasManyThrough {
        return $this->hasManyThrough(TaxEntry::class, County::class);
    }
}
