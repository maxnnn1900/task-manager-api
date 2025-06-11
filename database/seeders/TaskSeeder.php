<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = Task::factory(200)->create();
        $employees = Employee::where('status', 'working')->get();

        foreach ($tasks as $task) {
            // 90% задач — назначить
            if (rand(1, 100) <= 90) {
                $count = rand(1, min(3, $employees->count()));
                $assigned = $employees->random($count)->pluck('id');
                $task->employees()->sync($assigned);
            }
        }
    }
}
