<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Validator;

class DepartmentController extends Controller
{
    protected function index() {
    	$departments = Department::all();
    	return view('admin.department.index')->with('departments',$departments);
    }

    protected function add() {
    	return view('admin.department.add');
    }

    protected function store(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:150|unique:departments',
          'description' => 'required',
          'status' => 'required'
      ])->validate();

    	$department = new Department();
    	$department->name = $request->name;
    	$department->description = $request->description;
    	$department->status = $request->status;

    	if($department->save()) {
    		$request->session()->flash("message", "Department added successfully");
	    	return redirect('/admin/department');
    	}
    }

    protected function edit($id) {
    	$department = Department::find($id);
    	return view('admin.department.edit')->with('department',$department);
    }

    protected function update(Request $request, $id) {
    	Validator::make($request->all(), [
          'name' => 'required|max:150|unique:departments,name,'.$id,
          'description' => 'required',
          'status' => 'required'
      ])->validate();

    	$department = Department::find($id);

    	$department->name = $request->name;
    	$department->description = $request->description;
    	$department->status = $request->status;

    	if($department->save()) {
    		$request->session()->flash("message", "Department updated successfully");
	    	return redirect('/admin/department');
    	}
    }

    protected function delete(Request $request, $id) {
    	$department = Department::find($id);
    	if($department->delete()) {
    		$request->session()->flash("message", "Department deleted successfully");
	    	return redirect('/admin/department');
    	}
    }
}
