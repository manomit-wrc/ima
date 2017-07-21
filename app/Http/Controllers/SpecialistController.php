<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Specialist;
use Validator;

class SpecialistController extends Controller
{
    public function index() {
      $specialist = Specialist::All();
      
      return view('admin.specialist.index')->with('specialist',$specialist);
      
    }

    public function add() {
        return view('admin.specialist.add');
    }

    public function store(Request $request) {
        
        Validator::make($request->all(), [
          'specialist_name' => 'required|max:225',
        
      ])->validate();
        
        $specialist = new Specialist();
        $specialist->specialist_name=$request->specialist_name;
        $specialist->status	=$request->inputStatus;
        $specialist->save();
        return redirect('/admin/specialist');
    }

    public function edit($id) {
        
    	$specialistedit = Specialist::find($id);
        return view('admin.specialist.edit')->with('specialistedit',$specialistedit);
    }

    public function update(Request $request) {
        
        $id=$request->uid;

        Validator::make($request->all(), [
          'specialist_name' => 'required|max:225',
        
      ])->validate();
        
        $specialist = Specialist::find($id);

        
        $specialist->specialist_name=$request->specialist_name;
        $specialist->status	=$request->inputStatus;
        $specialist->save();
        return redirect('/admin/specialist');
    }

    public function delete($id) {

    	 $specialist = Specialist::find($id);
        if($specialist->delete()) {
        
        return redirect('/admin/specialist');
      }
        
    }
}
