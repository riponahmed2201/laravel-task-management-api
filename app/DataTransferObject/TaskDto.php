<?php

namespace App\DataTransferObject;

use App\Http\Requests\Api\TaskRequest;

class TaskDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $start_date,
        public readonly string $end_date,
        public readonly string $project,
        public readonly string $team_members,
        public readonly string $description,
        public readonly string $status,
    )
    {

    }

    public static function fromApiRequest(TaskRequest $taskRequest): TaskDto
    {
        return new self (
            name: $taskRequest->validated('name'),
            start_date: $taskRequest->validated('start_date'),
            end_date: $taskRequest->validated('end_date'),
            project: $taskRequest->validated('project'),
            team_members: $taskRequest->validated('team_members'),
            description: $taskRequest->validated('description'),
            status: $taskRequest->validated('status'),
        );
    }
}
