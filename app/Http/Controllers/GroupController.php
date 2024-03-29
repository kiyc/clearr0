<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGroupRequest;

use App\TaskGroup;

use DB;
use Log;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $items = TaskGroup::orderBy('sort', 'desc')->with('tasks')->get();

        return response()->json(['items' => $items]);
    }

    public function store(UpdateGroupRequest $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $group = new TaskGroup();
                $group->fill($request->all());
                $group->sort = TaskGroup::max('sort') + 1;
                $group->save();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        $items = TaskGroup::orderBy('sort', 'desc')->with('tasks')->get();

        return response()->json(['items' => $items]);
    }

    public function update(UpdateGroupRequest $request, TaskGroup $group)
    {
        try {
            DB::transaction(function() use ($request, $group) {
                $group->fill($request->all());
                $group->save();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        $items = TaskGroup::orderBy('sort', 'desc')->with('tasks')->get();

        return response()->json(['items' => $items]);
    }

    public function remove(TaskGroup $group)
    {
        try {
            DB::transaction(function() use ($group) {
                $group->delete();
                $group->tasks()->delete();
                TaskGroup::where('sort', '>', $group->sort)->decrement('sort');
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        $items = TaskGroup::orderBy('sort', 'desc')->with('tasks')->get();

        return response()->json(['items' => $items]);
    }
}
