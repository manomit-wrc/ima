<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Doctor;
use App\Journal;
//use App\Designation;
//use Validator;


class DoctorController extends Controller
{

  public function index() {
    	$doctors = Doctor::all();
      return view('admin.doctor.index')->with('doctor',$doctors);
    }
  public function view($id){
      
      $doctor = Doctor::with('journal.categories')->where('id',$id)->get()->toArray();
      return view('admin.doctor.view')->with('viewdoctor',$doctor);
     
   }
  public function Publised(Request $request,$id,$status){
    $journal = Journal::find($id);
   
    if($status=='0')
    {
      $journal->status =1;
    }
    else if($status=='1')
    {
      $journal->status =0;
    }
    $journal->save();
    $request->session()->flash("message", "Journal Publised successfully");
    return redirect('/admin/doctor/');
    
  }
  public function active(Request $request){
   
    $doctor = Doctor::find($request->id);
    
    $status=$request->status;
     
    if($status=='1')
    {
      $doctor->status=0;
    }
    else if($status=='0')
    {
      $doctor->status=1;
    }
    $doctor->save();
    return redirect('/admin/doctor/');
  }

}


?>