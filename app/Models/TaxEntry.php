<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxEntry extends Model
{
    public $fillable = [
        'amount',
        'county_id'
    ];

    public function county() : BelongsTo {
        return $this->belongsTo(County::class, 'county_id', 'id');
    }
}
