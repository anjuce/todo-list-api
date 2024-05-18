<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;
use App\Enums\TaskPriority;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user_id', 'title', 'description', 'status', 'priority', 'created_at', 'completed_at'
    ];

    /**
     * @param $value
     * @return false|int|string|null
     */
    public function getStatusAttribute($value)
    {
        return $value ? TaskStatus::getKey($value) : null;
    }

    /**
     * @param $value
     * @return false|int|string|null
     */
    public function getPriorityAttribute($value)
    {
        return $value ? TaskPriority::getKey($value) : null;
    }
}
