<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roomfn extends Model
{
    public $table = 'room_fn';

    protected $fillable = [
        'room_id',
        'user_id',
    ];

}
