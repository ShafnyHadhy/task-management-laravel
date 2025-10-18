<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'description',
        'category_id',
        'assignment_date',
        'deadline',
        'status',
        'user_id',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the task.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
