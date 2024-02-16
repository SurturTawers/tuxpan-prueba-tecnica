<?php

namespace Database\Seeders;

use App\Models\UserTasks;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userTasks = [
            [
                'task_id' => 1,
                'user_id' => 1,
                'assigned_at' => Carbon::now(),
            ]
        ];

        foreach ($userTasks as $userTask){
            UserTasks::create($userTask);
        }
    }
}
