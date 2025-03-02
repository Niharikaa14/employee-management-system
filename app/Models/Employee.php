<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // This defines a one-to-many relationship between Employee and Task
    // Meaning: One Employee can have many Tasks.
    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function department(){
        return $this->belongsTo(Department::class,'dept_id');
    }

}
