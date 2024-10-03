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
        $page = $request->get("page") ?? "1";
        $response = Http::get($request->url() . "/api/tasks?page=$page");
        $tasks = json_decode($response->body());
        $tasks->links = $this->updateLinks($tasks->links);
        return view('welcome', ['tasks' => $tasks]);
    }

    private function updateLinks(array $links): array
    {
        return array_map(function ($item) {
            $item->url = is_null($item->url) ? null : str_replace("/api/tasks", "", $item->url);
            return $item;
        }, $links);
    }
}
