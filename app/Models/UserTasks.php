<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTasks extends Pivot
{
    use HasFactory;

    protected $table = 'user_tasks';
    public $timestamps = false;

}
