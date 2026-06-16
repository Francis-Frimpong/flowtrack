<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function start(Request $request)
{
    $taskId = $request->task_id;

    // 1. Check if already running session exists
    $activeSession = Session::whereNull('end_time')->first();

    if ($activeSession) {
        return response()->json([
            'success' => false,
            'message' => 'A session is already running'
        ], 400);
    }

    // 2. Create new session
    $session = Session::create([
        'task_id' => $taskId,
        'start_time' => Carbon::now(),
        'end_time' => null,
        'duration_seconds' => 0
    ]);

    // 3. Return session
    return response()->json([
        'success' => true,
        'session' => $session
    ]);
}

public function stop(Request $request)
{
    // 1. Find active session
    $session = Session::whereNull('end_time')->first();

    if (!$session) {
        return response()->json([
            'success' => false,
            'message' => 'No active session found'
        ], 400);
    }

    // 2. Set end time
    $session->end_time = Carbon::now();

    // 3. Calculate duration
    $start = Carbon::parse($session->start_time);
    $end = Carbon::parse($session->end_time);

    $session->duration_seconds = $start->diffInSeconds($end, false);

    // 4. Save
    $session->save();

    return response()->json([
        'success' => true,
        'session' => $session
    ]);
}
}
