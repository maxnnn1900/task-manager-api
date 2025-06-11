<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

class AssignUnassignedTasks extends Command
{
    protected $signature = 'tasks:assign-tasks';
    protected $description = 'Назначает случайных сотрудников на задачи без исполнителей';

    public function handle(): int
    {
        $unassignedTasks = Task::doesntHave('employees')->get();
        $eligibleEmployees = Employee::where('status', 'working')->get();

        if ($eligibleEmployees->isEmpty()) {
            Log::warning('Нет доступных сотрудников для назначения');
            return Command::FAILURE;
        }

        foreach ($unassignedTasks as $task) {
            $selected = $eligibleEmployees->random(1)->pluck('id');
            $task->employees()->sync($selected);

            Log::debug("Задача #{$task->id} была автоматически назначена на сотрудника: " . $selected->implode(', '));
        }

        $this->info("Назначено задач: {$unassignedTasks->count()}");
        return Command::SUCCESS;
    }
}

