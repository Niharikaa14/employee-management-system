<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Validator;
use App\Models\Task;
use App\Mail\TaskAssignedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function add()
    {
        $employees = Employee::latest()->get();
        return view('admin.tasks.create', compact('employees'));
    }


    //     public function create(Request $request)
// {
//     // Validate Input
//     $validation = Validator::make($request->all(), [
//         'title' => 'required',
//         'content' => 'required',
//         'employee' => 'required|exists:employees,id', // Ensure employee exists
//         'status' => 'required',
//         'date' => 'required|date',
//         'deadline' => 'required|date',
//     ]);

    //     if ($validation->fails()) {
//         return response()->json([
//             'success' => false,
//             'message' => $validation->errors()->all(),
//         ]);
//     }

    //     try {
//         // Create Task
//         $task = new Task();
//         $task->title = $request->title;
//         $task->content = $request->content;
//         $task->emp_id = $request->employee;
//         $task->status = $request->status;
//         $task->date = $request->date;
//         $task->deadline = $request->deadline;
//         $task->save();

    //         // Fetch Employee Details
//         $employee = Employee::find($request->employee);
//         if (!$employee) {
//             Log::error('Employee not found for ID: ' . $request->employee);
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Employee not found',
//             ]);
//         }

    //         Log::info('Task created successfully', ['task' => $task, 'employee' => $employee]);

    //         // Send Email Notification
//         Mail::to($employee->email)->send(new TaskAssignedMail($task, $employee));

    //         Log::info('Email sent to: ' . $employee->email);

    //         return response()->json([
//             'success' => true,
//             'message' => 'Task added and email sent successfully',
//         ]);

    //     } catch (\Exception $e) {
//         // Log Error
//         Log::error('Error while creating task or sending email: ' . $e->getMessage());

    //         return response()->json([
//             'success' => false,
//             'message' => 'Task created but email failed: ' . $e->getMessage(),
//         ]);
//     }
// }

    public function create(Request $request)
    {
        // Validate Input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'employee' => 'required|exists:employees,id',
            'status' => 'required|boolean',
            'date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(), // Return errors as an associative array
            ], 422);
        }

        try {
            $task = Task::create([
                'title' => $request->title,
                'content' => $request->content,
                'emp_id' => $request->employee,
                'status' => $request->status,
                'date' => $request->date,
                'deadline' => $request->deadline,
            ]);

            // Fetch Employee Details
            $employee = Employee::find($request->employee);

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found',
                ]);
            }

            // Send Email Notification
            Mail::to($employee->email)->send(new TaskAssignedMail($task, $employee));

            return response()->json([
                'success' => true,
                'message' => 'Task created and email sent successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('Error while creating task: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Task creation failed! ' . $e->getMessage(),
            ]);
        }
    }


    public function delete(Request $request)
    {
        $task = Task::find($request->id);
        $result = $task->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Task not deleted'
            ]);
        }
    }

    public function edit($id)
    {
        $task = Task::find($id);
        $employees = Employee::latest()->get();
        return view('admin.tasks.update', compact('task', 'employees'));
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'employee' => 'required',
            'status' => 'required',
            'date' => 'required',
            'deadline' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $task = Task::find($request->id);
            $task->title = $request->title;
            $task->content = $request->content;
            $task->emp_id = $request->employee;
            $task->status = $request->status;
            $task->date = $request->date;
            $task->deadline = $request->deadline;
            $result = $task->save();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Task updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Task not updated'
                ]);
            }
        }
    }


    // email
    public function assignTask(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'deadline' => 'required',
                'emp_id' => 'required|exists:employees,id',
            ]);

            // Create Task
            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->deadline = $request->deadline;
            $task->emp_id = $request->emp_id;
            $task->save();

            // Get Employee Details
            $employee = Employee::findOrFail($request->emp_id);

            // Send Email
            Mail::to($employee->email)->send(new TaskAssignedMail($task, $employee));

            Log::info('Email sent to: ' . $employee->email);

            return response()->json([
                'success' => true,
                'message' => 'Task assigned and email sent successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Email Sending Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Task assigned but email failed: ' . $e->getMessage()
            ]);
        }
    }

}
