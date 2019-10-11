<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class County extends Model
{
    public $fillable = [
        'name',
        'tax_rate',
        'state_id',
    ];

    public function state() : BelongsTo {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function entries() : HasMany {
        return $this->hasMany(TaxEntry::class, 'county_id', 'id');
    }
}
