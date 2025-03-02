<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Employee\EmployeeTaskController;

class HomeController extends Controller
{
    //
    public function index()
{
    if (Auth::check()) { // Check if user is authenticated
        // dd(Auth::user());
        // dd(Auth::user()->toArray());
        // $user = User::where('email', 'admin@admin.com')->first(); // Replace with your admin email
        // dd($user)->toArray();
        $usertype = Auth::user()->usertype;

        switch ($usertype) {
            case 'employee':
                $employeeTaskController = new EmployeeTaskController();
                    return $employeeTaskController->dashboard(); // Use the dashboard method so $taskCount is included
            case 'admin':
                return view('admin.dashboard');
            case 'manager':
                return view('manager.dashboard');
            case 'hr':
                return view('hr.dashboard');
            default:
            return view('welcome');
                // return view('home'); // Redirect to home if user type is unknown
        }
    }

    return redirect()->route('login'); // Redirect to login if user is not authenticated
}


public function post()
{
    $users = User::all();
    return view('post', compact('users'));

}

}