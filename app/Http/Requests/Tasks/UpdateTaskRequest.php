<?php

namespace App\Http\Requests\Tasks;

use App\Enums\Priority;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:480'],
            'priority' => ['required', Rule::enum(Priority::class)],
            'completed' => ['required', 'boolean'],
        ];
    }
}
