<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Session;
use Carbon\Carbon;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }

   

    public function store(Request $request)
    {
         
        $task = Task::create([
            'title' => $request->title
        ]);

        return response()->json($task);
    }

    public function insightPage()
    {
        $totalSeconds = Session::whereDate('start_time', Carbon::today())
        ->sum('duration_seconds');

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);

        $tasks = Task::withSum([
        'sessions as today_seconds' => function ($query) {
            $query->whereDate('start_time', today());
        }
        ], 'duration_seconds')->get();
        
        return view('insight', compact(['hours', 'minutes', 'tasks']));
    }
}
