<?php

namespace App\Models;

use App\Enums\EmployeeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'status'];

    protected $casts = [
        'status' => EmployeeStatus::class,
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
