<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AdminAttendanceController extends Controller
{
    //

    public function index()
    {
        $attendances = Attendance::all(); // Fetching attendance with employee info
        return view('admin.attendance.index', compact('attendances'));
    }


}
