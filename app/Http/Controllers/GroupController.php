<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Group\StoreUpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    public function store(StoreUpdateGroupRequest $request)
    {
        $validated = $request->safe()->only(['title', 'color']);

        $group = Group::create([
            'title' => $validated['title'],
            'user_id' => $request->user()->id,
            'color' => $validated['color'],
        ]);

        return response()->json(
            ['message' => 'Group created successfully', 'data' => $group],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request)
    {
        return Group::where('user_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function update(StoreUpdateGroupRequest $request, string $id)
    {
        $group = Group::where([
            'id' => $id,
            'user_id' => $request->user()->id,
        ])->firstOrFail();

        $validated = $request->safe()->only(['title', 'color']);

        $group->title = $validated['title'];
        $group->color = $validated['color'];
        $saved = $group->save();

        if (!$saved) {
            return response()->json(
                ['error' => 'Failed to update the group'],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }

        return response()->json(
            ['message' => 'Group Successfully updated', 'data' => $group],
            Response::HTTP_OK,
        );
    }

    public function destroy(Request $request, string $id)
    {
        $group = Group::where([
            'id' => $id,
            'user_id' => $request->user()->id,
        ])->firstOrFail();

        $deleted = $group->delete();

        if (!$deleted) {
            return response()->json(
                ['error' => 'Failed to delete the group'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response(null, RESPONSE::HTTP_NO_CONTENT);
    }
}
