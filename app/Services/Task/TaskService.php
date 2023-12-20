<?php

namespace App\Services\Task;

use App\DataTransferObject\TaskDto;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function getAllTaskList($request): Collection
    {
        $status = $request->query('status');
        $searchKeyword = $request->query('searchKeyword');

        $tasks = Task::latest();

        if (!empty($status)) {
            $tasks = $tasks->where('status', $status);
        }

        if (!empty($searchKeyword)) {
            $tasks = $tasks->where(function ($query) use ($searchKeyword) {
                $query->where('name', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('project', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('description', 'like', '%' . $searchKeyword . '%');
            });
        }

        return $tasks->get();
    }

    public function storeTask(TaskDto $taskDto)
    {
        return Task::create([
            'name' => $taskDto->name,
            'status' => $taskDto->status,
            'start_date' => $taskDto->start_date,
            'end_date' => $taskDto->end_date,
            'project' => $taskDto->project,
            'team_members' => $taskDto->project,
            'description' => $taskDto->description,
        ]);
    }

    public function updateTask($taskId, TaskDto $taskDto)
    {
        return tap(Task::where("id", $taskId))->update([
            'name' => $taskDto->name,
            'status' => $taskDto->status,
            'start_date' => $taskDto->start_date,
            'end_date' => $taskDto->end_date,
            'project' => $taskDto->project,
            'team_members' => $taskDto->project,
            'description' => $taskDto->description,
        ]);
    }

    public function getTaskById($taskId)
    {
        return Task::where('id', $taskId)->first();
    }

    public function deleteTaskById($taskId)
    {
        return Task::where('id', $taskId)->delete();
    }
}
