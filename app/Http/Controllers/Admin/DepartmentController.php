<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Validator;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        $departments = Department::latest()->get();
        return view('admin.departments.index',compact('departments'));
    }

    public function add()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'success' => 'false', 
                'message' => $validation->errors()->all()
            ]);
        }else{
            $department = new Department();
            $department->name = $request->name;
            $department->save();
            return response()->json([
                'success' => 'true', 
                'message' => 'Department added successfully'
            ]);
        }

    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.departments.update',compact('department'));
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'success' => 'false', 
                'message' => $validation->errors()->all()
            ]);
        }else{
            $department = Department::find($request->id);
            $department->name = $request->name;
            $department->save();
            return response()->json([
                'success' => 'true', 
                'message' => 'Department updated successfully'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $department = Department::find($request->id);
        $department->delete();
        return response()->json([
            'success' => 'true', 
            'message' => 'Department deleted successfully'
        ]);
    }

}
