<?php

namespace App\Models;

use App\Interfaces\IState;
use Illuminate\Database\Eloquent\Model;

class State extends Model implements IState
{
    public $fillable = [
        'name',
    ];

    function getName(): String {
        return $this->name;
    }
}
