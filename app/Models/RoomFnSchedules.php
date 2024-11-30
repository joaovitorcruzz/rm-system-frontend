<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFnSchedules extends Model
{
    public $table = 'room_fn_schedules';

    protected $fillable = [
        'room_id',
        'schedule_id',
        'user_id',
    ];

}
