<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;

class EmployeeController extends Controller
{
    //

    public function index()
    {

        $employees = Employee::latest()->get();
        return view('admin.employees.index', compact('employees'));
    }

    // public function index()
    // {
    //     $employees = User::where('role', 'employee')->get(); // Assuming 'role' column exists
    //     return view('admin.employees.index', compact('employees'));
    // }


    public function add()
    {
        $departs = Department::latest()->get();
        return view('admin.employees.create', compact('departs'));
    }

    // public function create(Request $request){
    //     $validation=Validator::make($request->all(),[
    //         'name'=>'required',
    //         'email'=>'required|email|unique',
    //         'password'=>'required',
    //         'phone'=>'required',
    //         'dob'=>'required',
    //         'city'=>'required',
    //         'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
    //     ]);

    //     if($validation->fails()){
    //         return response()->json([
    //             'success'=>false,
    //             'message'=>$validation->errors()->all()
    //     ]);
    //     }
    //     else{
    //         $employee=new Employee();

    //         $filename="";
    //         if($request->file('image')){
    //             $filename=$request->file('image')->store('employee','public');
    //         }

    //         $employee->name=$request->name;
    //         $employee->email=$request->email;
    //         $employee->password=Hash::make($request->password);
    //         $employee->image=$filename;
    //         $employee->phone=$request->phone;
    //         $employee->dob=$request->dob;
    //         $employee->city=$request->city;
    //         $result=$employee->save();

    //         if($result){
    //             return response()->json([
    //                 'success'=>true,
    //                 'message'=>'Employee created successfully'
    //             ]);
    //         }
    //         else{
    //             return response()->json([
    //                 'success'=>false,
    //                 'message'=>'Employee creation failed'
    //             ]);
    //         }
    //     }
    // }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'department' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $employee = new Employee();

            $filename = "";
            if ($request->file('image')) {
                $filename = $request->file('image')->store('employee', 'public');
            }

            $employee->name = $request->name;
            $employee->dept_id = $request->department;
            $employee->email = $request->email;
            $employee->dob = $request->dob;
            $employee->city = $request->city;
            $employee->phone = $request->phone;
            $employee->password = Hash::make($request->password);
            $employee->image = $filename;

            $result = $employee->save();
            if ($result) {
                return response()->json([
                    "success" => true,
                    'message' => [
                        'Employee Create Successfully'
                    ]
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    'message' => [
                        'Employee Not Create Successfully'
                    ]
                ]);
            }
        }
    }

    // public function edit($id)
    // {
    //     $employees = Employee::findOrFail($id);
    //     return view('admin.employees.update', compact('employees'));
    // }

    public function edit($id)
    {
        $employees = Employee::findOrFail($id);
        $departs = Department::latest()->get(); // Fetch all departments

        return view('admin.employees.update', compact('employees', 'departs'));
    }


    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'department' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $employee = Employee::findOrFail($request->id);
            ;

            $filename = "";
            $path = public_path('storage\\' . $request->old_image);
            if ($request->file('image')) {
                if (File::exists($path)) {
                    File::delete($path);
                }
                $filename = $request->file('image')->store('employee', 'public');
            } else {
                $filename = $request->old_image;
            }

            $employee->name = $request->name;
            $employee->dept_id = $request->department;
            $employee->email = $request->email;
            $employee->dob = $request->dob;
            $employee->city = $request->city;
            $employee->phone = $request->phone;
            $employee->image = $filename;

            $result = $employee->save();
            if ($result) {
                return response()->json([
                    "success" => true,
                    'message' => [
                        'Employee Update Successfully'
                    ]
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    'message' => [
                        'Employee Not Create Successfully'
                    ]
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $employee = Employee::findOrFail($id);
        $path = public_path('storage\\' . $employee->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $result = $employee->delete();
        if ($result) {
            return response()->json([
                "success" => true,
                'message' => [
                    'Employee Delete Successfully'
                ]
            ]);
        } else {
            return response()->json([
                "success" => false,
                'message' => [
                    'Employee Not Delete Successfully'
                ]
            ]);
        }
    }

}
