<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'date', 'start_time', 'finish_time', 'total_hours'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
