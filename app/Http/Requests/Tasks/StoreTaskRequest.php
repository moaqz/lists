<?php

namespace App\Http\Requests\Tasks;

use App\Enums\Priority;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:480'],
            'priority' => ['nullable', Rule::enum(Priority::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'group_id.exists' => 'The group is not available.'
        ];
    }
}
