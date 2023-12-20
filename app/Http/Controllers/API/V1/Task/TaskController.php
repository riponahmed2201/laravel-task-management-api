<?php

namespace App\Http\Controllers\API\V1\Task;

use App\DataTransferObject\TaskDto;
use App\Enums\TaskStatus;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskRequest;
use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            //Pass to the task service
            $tasks = $this->taskService->getAllTaskList($request);

            return (new Helper())->sendSuccessResponse(200, 'Task list fetch successfully.', 'tasks', $tasks);
        } catch (\Exception $exception) {
            return (new Helper())->sendErrorResponse('Task was not found.', $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $taskRequest): JsonResponse
    {
        try {
            //Pass to task service
            $this->taskService->storeTask(TaskDto::fromApiRequest($taskRequest));

            return (new Helper())->sendSuccessResponse(201, 'Task created successfully.');

        } catch (\Exception $exception) {
            return (new Helper())->sendErrorResponse('Task was not created.', $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $taskId)
    {
        try {

            //Pass to task service
            $task = $this->taskService->getTaskById($taskId);

            return (new Helper())->sendSuccessResponse(200, 'Task info fetch successfully.', 'task', $task);

        } catch (\Exception $exception) {
            return (new Helper())->sendErrorResponse('Task was not found.', $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $taskRequest, int $taskId): JsonResponse
    {
        try {

            //Pass to task service
            $this->taskService->updateTask($taskId, TaskDto::fromApiRequest($taskRequest));

            return (new Helper())->sendSuccessResponse(200, 'Task updated successfully');

        } catch (\Exception $exception) {
            return (new Helper())->sendErrorResponse('Task was not updated.', $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $taskId)
    {
        try {

            //Pass to task service
            $task = $this->taskService->deleteTaskById($taskId);

            return (new Helper())->sendSuccessResponse(200, 'Task deleted successfully.');

        } catch (\Exception $exception) {
            return (new Helper())->sendErrorResponse('Task was not deleted.', $exception->getMessage(), $exception->getCode());
        }
    }
}
