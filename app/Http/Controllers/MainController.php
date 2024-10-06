<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        $page = $request->get("page") ?? "1";
        $sort = $request->get("sort") ?? "username";
        $response = Http::get($request->getSchemeAndHttpHost() . "/api/tasks?page=$page&sort=$sort");
        $tasks = json_decode($response->body());
        $tasks->links = $this->updateLinks($tasks->links);
        return view('welcome', ['tasks' => $tasks, 'sort' => $sort]);
    }

    public function create(Request $request): View
    {
        $id = $request->get("id");
        $params = ["id" => $id, "description" => null, "is_done" => null];
        if ($id) {
            $response = Http::get($request->getSchemeAndHttpHost() . "/api/tasks/$id");
            $task = json_decode($response->body());
            $params["description"] = $task->description;
            $params["is_done"] = $task->is_done;
        }
        return view('edit', $params);
    }

    public function store(Request $request): RedirectResponse
    {
        Http::withBody(json_encode($request->getPayload()->all()), 'application/json')->post(
            $request->getSchemeAndHttpHost() . "/api/tasks"
        );
        return redirect()->intended();
    }

    public function update(Request $request): RedirectResponse
    {
        $task = $request->getPayload()->all();
        $task["is_done"] = $task["is_done"] == "on" ? 1 : 0;
        $id = $task["id"];
        Http::withBody(json_encode($task), 'application/json')->patch(
            $request->getSchemeAndHttpHost() . "/api/tasks/$id"
        );
        return redirect()->intended();
    }

    private function updateLinks(array $links): array
    {
        return array_map(function ($item) {
            $item->url = is_null($item->url) ? null : str_replace("/api/tasks", "", $item->url);
            return $item;
        }, $links);
    }
}
