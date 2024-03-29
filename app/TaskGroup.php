<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'sort',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task', 'task_groups_id')->orderBy('sort', 'desc');
    }
}
