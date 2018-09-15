<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaskRequest;

use App\TaskGroup;
use App\Task;

use DB;
use Log;

class TaskController extends Controller
{
    public function store(UpdateTaskRequest $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $task = new Task();
                $task->fill($request->all());
                $task->sort = Task::max('sort') + 1;
                $task->save();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        $items = TaskGroup::orderBy('sort', 'desc')->with('tasks')->get();

        return response()->json(['items' => $items]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            DB::transaction(function() use ($request, $task) {
                $task->fill($request->all());
                $task->save();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        $items = TaskGroup::orderBy('sort', 'desc')->with('tasks')->get();

        return response()->json(['items' => $items]);
    }

    public function remove(Task $task)
    {
        try {
            DB::transaction(function() use ($task) {
                $task->delete();
                Task::where('sort', '>', $task->sort)->decrement('sort');
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        $items = TaskGroup::orderBy('sort', 'desc')->with('tasks')->get();

        return response()->json(['items' => $items]);
    }
}
