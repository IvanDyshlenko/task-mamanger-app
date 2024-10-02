<?php

use App\Http\Controllers\TaskController;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Support\Facades\Route;

Route::apiResource("/tasks", TaskController::class)->
    only(["index", "store", "show", "update"])->
    middleware(ForceJsonResponse::class);
