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
        $items = TaskGroup::orderBy('sort', 'desc')->get();

        return response()->json(['items' => $items]);
    }

    public function store(UpdateGroupRequest $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $group = new TaskGroup();
                $group->fill($request->all());
                $group->save();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json(0);
    }

    public function update(UpdateGroupRequest $request, TaskGroup $group)
    {
        try {
            DB::transaction(function() use ($request, $group) {
                $group = new TaskGroup();
                $group->fill($request->all());
                $group->save();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json(0);
    }

    public function destroy(TaskGroup $group)
    {
        try {
            DB::transaction(function() use ($group) {
                $group->delete();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json(0);
    }
}
