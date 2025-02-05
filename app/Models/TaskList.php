<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    /** @use HasFactory<\Database\Factories\TaskListFactory> */
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * Get all of the Task for the TaskList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Task()
    {
        return $this->hasMany(Task::class);
    }
}
