<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'task_groups_id',
        'content',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
