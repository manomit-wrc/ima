<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Qualification;
use Validator;

class QualificationController extends Controller
{
    //
    public function index() {
      $qualification = Qualification::All();
      
      return view('admin.qualification.index')->with('qualification',$qualification);
    }

    public function add() {
        return view('admin.qualification.add');
    }

    public function store(Request $request) {
        
        Validator::make($request->all(), [
          'qualification_name' => 'required|max:225',
        
      ])->validate();
        
        $qualification = new Qualification();
        $qualification->qualification_name=$request->qualification_name;
        $qualification->status	=$request->inputStatus;
        $qualification->save();
        return view('admin.qualification.index');
    }

    public function edit($id) {

    	$qualificationedit = Qualification::find($id);

    	 

        return view('admin.qualification.edit')->with('qualificationedit',$qualificationedit);
    }

    public function update(Request $request) {
        
        $id=$request->uid;

        Validator::make($request->all(), [
          'qualification_name' => 'required|max:225',
        
      ])->validate();
        
        $qualification = Qualification::find($id);

        
        $qualification->qualification_name=$request->qualification_name;
        $qualification->status	=$request->inputStatus;
        $qualification->save();
        return redirect('/admin/qualification');
    }

    public function delete($id) {

    	 $qualification = Qualification::find($id);
      if($qualification->delete()) {
        
        return redirect('/admin/qualification');
      }
        
    }
}
