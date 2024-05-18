<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class IndexTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'sort_by' => 'sometimes|array',
            'sort_by.*' => 'in:createdAt,completedAt,priority,-createdAt,-completedAt,-priority',

            'status' => 'nullable|in:todo,done',
            'priority' => 'nullable|integer|min:1|max:5',
            'search' => 'nullable|string',
        ];
    }
}
