<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'completed', 'name', 'description',
    ];

    protected $primaryKey = 'task_id';
}
