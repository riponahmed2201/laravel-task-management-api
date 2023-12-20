<?php

namespace App\Http\Requests\Api;

use App\Enums\TaskStatus;
use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TaskRequest extends FormRequest
{
    use ApiValidationErrorResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'status' => ['required', new Enum(TaskStatus::class)],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'project' => ['required'],
            'team_members' => ['required'],
            'description' => ['required'],
        ];
    }
}
