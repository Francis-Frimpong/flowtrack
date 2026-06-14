<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }

    public function insightPage()
    {
        return view('insight');
    }

    public function store(Request $request)
    {
         
        $task = Task::create([
            'title' => $request->title
        ]);

        return response()->json($task);
    }
}
