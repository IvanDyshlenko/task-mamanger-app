<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Request;

class TaskController extends Controller
{
    const PAGE_SIZE = 3;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort = Request::get("sort") ?? "username";
        $tasks = Task::orderBy($sort)->paginate(self::PAGE_SIZE);;
        $tasks->appends(['sort' => $sort]);
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        return Task::factory()->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->fill($request->except(["id"]));
        $task->save();
        return response()->json($task);
    }
}
