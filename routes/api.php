<?php

use App\Http\Controllers\TaskController;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Support\Facades\Route;

Route::apiResource("/tasks", TaskController::class)->
    only(["index", "store", "show", "update"])->
    names(["tasks.index", "tasks.store", "tasks.show", "tasks.update"])->
    middleware(ForceJsonResponse::class);
