<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_at',
        'is_active'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'user_tasks','task_id','user_id')
            ->as('user_tasks')
            ->withPivot('assigned_at')
            ->using(UserTasks::class);
    }
}
