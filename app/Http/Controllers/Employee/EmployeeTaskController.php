<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class EmployeeTaskController extends Controller
{
    //

    public function dashboard()
    {
        $taskCount = Task::where('emp_id', Auth::id())->count();
        $employeeName = Auth::user()->name;
        return view('employee.dashboard', compact('taskCount', 'employeeName'));
    }

    public function index()
    {
        $tasks = Task::where('emp_id', Auth::id())->get(); // Assuming employee_id exists in tasks table
        return view('employee.MyTask.index', compact('tasks'));
    }

    public function updateStatus(Request $request, $id)
{
    $task = Task::findOrFail($id);
    $task->status = $request->status;
    $task->save();

    return redirect()->route('employee.task.list')->with('success', 'Task status updated successfully');
}

}
