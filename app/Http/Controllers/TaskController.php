<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    const PAGE_SIZE = 3;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $flights = Flight::where('active', 1)
//            ->orderBy('name')
//            ->take(10)
//            ->get();
        return Task::paginate(self::PAGE_SIZE);
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
