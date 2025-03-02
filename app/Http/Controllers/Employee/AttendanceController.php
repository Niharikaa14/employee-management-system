<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    
    public function start()
    {
        Attendance::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'start_time' => now()->toTimeString(),
        ]);

        return back()->with('success', 'Attendance started!');
    }

    public function finish()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if ($attendance) {
            $attendance->update([
                'finish_time' => now()->toTimeString(),
                'total_hours' => now()->diffInHours($attendance->start_time),
            ]);
        }

        return back()->with('success', 'Attendance finished!');
    }

}
