<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'user_id' => 1,
            'title' => 'Sample Task 1',
            'description' => 'This is a sample task.',
            'status' => 'todo',
            'priority' => 3,
            'created_at' => now(),
        ]);

        Task::create([
            'user_id' => 1,
            'title' => 'Sample Task 2',
            'description' => 'Another sample task.',
            'status' => 'done',
            'priority' => 2,
            'created_at' => now(),
        ]);

        Task::create([
            'user_id' => 2,
            'title' => 'Sample Task 1',
            'description' => 'This is a sample task.',
            'status' => 'todo',
            'priority' => 1,
            'created_at' => now(),
        ]);

        Task::create([
            'user_id' => 2,
            'title' => 'Sample Task 2',
            'description' => 'Another sample task.',
            'status' => 'done',
            'priority' => 2,
            'created_at' => now(),
        ]);

    }
}
