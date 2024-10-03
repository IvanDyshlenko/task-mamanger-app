<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        //$tasks = redirect()->route('tasks.index')->;
        $response = Http::get($request->url() . "/api/tasks");
        //return view('welcome', ['tasks' => json_decode($tasks)]);
        $tasks = json_decode($response->body());
        return view('welcome', ['tasks' => $tasks]);
    }
}
