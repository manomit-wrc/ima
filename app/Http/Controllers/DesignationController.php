<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;

use Validator;

class DesignationController extends Controller
{
    public function index() {

    	$designation_list = Designation::all();
    	return view('admin.designation.index')->with('designation_list',$designation_list);
    }

    public function add() {
    	return view('admin.designation.add');
    }

    public function store(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:40|unique:designations',
          'status' => 'required'
      ])->validate();

    	$designation = new Designation();
    	$designation->name = $request->name;
    	$designation->status = $request->status;
    	$designation->save();

    	$request->session()->flash("message", "Designation added successfully");
	    return redirect('/admin/designation');
    }

    public function edit($id) {
    	$designation_list = Designation::find($id);
    	return view('admin.designation.edit')->with('designation_list',$designation_list);
    }

    public function update(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:40|unique:designations,name,'.$request->id,
          'status' => 'required'
      ])->validate();

    	$designation = Designation::find($request->id);
    	$designation->name = $request->name;
    	$designation->status = $request->status;
    	$designation->save();

    	$request->session()->flash("message", "Designation updated successfully");
	    return redirect('/admin/designation');
    }
    public function delete(Request $request,$id) {
    	$designation = Designation::find($id);
    	if($designation->delete()) {
    		$request->session()->flash("message", "Designation deleted successfully");
	    	return redirect('/admin/designation');
    	}
    }
}
