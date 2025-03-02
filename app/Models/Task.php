<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'title',
        'content',
        'emp_id', // Foreign key linking to employees table
        'status',
        'date',
        'deadline',
    ];

    // This defines a many-to-one relationship between Task and Employee.
    // Meaning: Many Tasks can belong to one Employee.
    public function employee(){
        return $this->belongsTo(Employee::class,'emp_id');
    }

}
