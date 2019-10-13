<?php

namespace App\Models;

use App\Interfaces\IState;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $fillable = [
        'name',
    ];

    function getName(): String {
        return $this->name;
    }
}
