<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'title' => 'Task 1',
                'description' => 'description',
                'priority' => 1,
                'due_at' => Carbon::tomorrow(),
            ],
            [
                'title' => 'Task 2',
                'description' => 'description',
                'priority' => 1,
                'due_at' => Carbon::tomorrow(),
            ],
            [
                'title' => 'Task 3',
                'description' => 'description',
                'priority' => 1,
                'due_at' => Carbon::tomorrow(),
            ],
        ];

        foreach ($tasks as $task){
            Task::create($task);
        }
    }
}
