<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request, string $groupId)
    {
        return Task::where([
            'group_id' => $groupId,
            'user_id' => $request->user()->id,
        ])
            ->latest()
            ->simplePaginate(30);
    }

    public function store(StoreTaskRequest $request, string $groupId)
    {
        Group::where('id', $groupId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $validated = $request->safe()->only([
            'content',
            'priority',
        ]);


        $task = Task::create([
            ...$validated,
            'priority' => $validated['priority'] ?? Priority::NONE->value,
            'user_id' => $request->user()->id,
            'group_id' => $groupId,
        ]);

        return response()->json(
            ['data' => $task],
            Response::HTTP_CREATED,
        );
    }

    public function show(Request $request, string $groupId, string $taskId)
    {
        $task =  Task::where([
            'id' => $taskId,
            'user_id' => $request->user()->id,
        ])->firstOrFail();

        return response()->json(['data' => $task]);
    }

    public function update(UpdateTaskRequest $request, string $groupId, string $taskId)
    {
        $validated = $request->safe()->only([
            'content',
            'priority',
            'completed',
        ]);

        $updated = Task::where([
            'id' => $taskId,
            'user_id' => $request->user()->id,
        ])->firstOrFail()->update($validated);

        if (!$updated) {
            return response()->json(
                ['error' => 'Failed to update task'],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }

        return response()->json(
            ['message' => 'Task Successfully updated'],
            Response::HTTP_OK,
        );
    }

    public function destroy(Request $request, string $groupId, string $taskId)
    {
        Task::where([
            'id' => $taskId,
            'user_id' => $request->user()->id,
        ])->first()->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
