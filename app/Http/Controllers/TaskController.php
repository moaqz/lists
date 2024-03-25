<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return Task::where(['user_id' => $request->user()->id])
            ->orderBy('created_at', 'desc')
            ->simplePaginate(30);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->safe()->only([
            'content',
            'priority',
            'group_id',
        ]);

        return Task::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);
    }

    public function show(Request $request, string $id)
    {
        return Task::where([
            'id' => $id,
            'user_id' => $request->user()->id,
        ])->firstOrFail();
    }

    public function update(UpdateTaskRequest $request, string $id)
    {
        $validated = $request->safe()->only([
            'content',
            'priority',
            'completed',
        ]);

        $updated = Task::where([
            'id' => $id,
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

    public function destroy(Request $request, string $id)
    {
        $deleted = Task::where([
            'id' => $id,
            'user_id' => $request->user()->id,
        ])->firstOrFail()->delete();

        if (!$deleted) {
            return response()->json(
                ['error' => 'Failed to delete task'],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
