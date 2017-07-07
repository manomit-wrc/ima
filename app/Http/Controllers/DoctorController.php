<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Doctor;
use App\Journal;
use App\Qualification;
//use Validator;


class DoctorController extends Controller
{

  public function index() {
    	$doctors = Doctor::with('states')->where('type','D')->get();
      
      return view('admin.doctor.index')->with('doctor',$doctors);
    }
  public function view($id){
      
      $doctor = Doctor::with('journal.categories')->where('id',$id)->get()->toArray();

      $doctor_qualifs = Doctor::with('doctor_qualifications')->where('id',$id)->get()->toArray();
      
      $doctor_certificates = explode(",", $doctor_qualifs[0]['certificate']);
      //$doctor_quali=[];
      /*foreach($doctor_qualifs[0]['doctor_qualifications']  as $key=>$value)
      {
         $doctor_quali[]=$value['qualification_name'];
      }*/

      /*echo "<pre>";
      print_r($doctor_qualifs);
      echo "</pre>";die();*/
      return view('admin.doctor.view')->with(['viewdoctor'=>$doctor,'doctor_qualifs'=>$doctor_qualifs,'doctor_certificates'=>$doctor_certificates]);
     
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
  
  public function downloadcertificate(Request $request,$file)
  {
     $file=public_path("/uploads/doctors/qualification/".$file);
     return response()->download($file);

  }

  public function downloadjournal(Request $request,$file)
  {
         $file=public_path("/uploads/doctors/journal/".$file);
         return response()->download($file);
  }

}


?>