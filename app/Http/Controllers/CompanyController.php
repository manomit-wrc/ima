<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\State;
use Validator;
use Image;
use Hash;
use JWTAuth;

class CompanyController extends Controller
{
    public function index() {
    	$companies = Doctor::with('states')->where('type','C')->get();
      	return view('admin.company.index')->with('companies',$companies);
    }

    public function add() {
    	$state_list = \App\State::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
    	return view('admin.company.add')->with('state_list',$state_list);
    }

    public function store(Request $request) {
    	Validator::make($request->all(), [
          'company_name' => 'required|max:225',
          'company_address' => 'required',
          'email' => 'required|email|unique:doctors,email',
          'password' => 'required',
          'mobile_no' => 'required',
          'avators' => 'required',
          'company_regsitration_no' => 'required',
          'date_of_establishment' => 'required|date_format:d-m-Y|',
          'state_id' => 'required',
          'city' => 'required',
          'pincode' => 'required',
          'inputStatus' => 'required'
      ])->validate();
         
        $doctor = new Doctor();

        if($request->hasFile('avators')) {
        $file = $request->file('avators') ;
        $fileName = time().'_'.$file->getClientOriginalName() ;
        $destinationPath = public_path().'/uploads/doctors/thumb' ;
        $img = Image::make($file->getRealPath());
        $img->resize(200, 200, function ($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$fileName);
        $destinationPath = public_path().'/uploads/doctors/' ;
        $file->move($destinationPath,$fileName);

          $doctor->avators=$fileName;
        }

        //$doctor = new Doctor();
        $doctor->first_name = $request->company_name;
        $doctor->last_name='';
        $doctor->address = $request->company_address;	
        $doctor->email = $request->email;
        $doctor->password=bcrypt($request->password);
        $doctor->mobile = $request->mobile_no;
        $doctor->company_regsitration_no = $request->company_regsitration_no;
        $doctor->doe=date("Y-m-d",strtotime($request->date_of_establishment));
        $doctor->state_id=$request->state_id;

        $doctor->city=$request->city;
        $doctor->pincode = $request->pincode;
        $doctor->type = 'C';
        $doctor->status = $request->inputStatus;
        
        $doctor->save();

        //$request->session()->flash("message", "Company added successfully");
	    return redirect('/admin/company');
    }

    public function edit($id)
    {
        $companies = Doctor::find($id);
        
        $state_list = \App\State::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
        return view('admin.company.edit')->with(['companies'=>$companies,'state_list'=>$state_list]); 
    }

    public function update(Request $request)
    {
      $id=$request->uid;  
      Validator::make($request->all(), [
          'company_name' => 'required|max:225',
          'company_address' => 'required',
          'email' => 'required|email|unique:doctors,email,'.$id,
          
          'mobile_no' => 'required',
          'company_regsitration_no' => 'required',
          'date_of_establishment' => 'required|date_format:d-m-Y|',
          'state_id' => 'required',
          'city' => 'required',
          'pincode' => 'required',
          'inputStatus' => 'required'
      ])->validate();
      

      if($request->hasFile('avators')) {
        $file = $request->file('avators') ;
        $fileName = time().'_'.$file->getClientOriginalName() ;
        $destinationPath = public_path().'/uploads/doctors/thumb' ;
        $img = Image::make($file->getRealPath());
        $img->resize(200, 200, function ($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$fileName);
        $destinationPath = public_path().'/uploads/doctors/' ;
        $file->move($destinationPath,$fileName);
          
          $updatefilename=$fileName;
          //$doctor->avators=$fileName;

        }
        else{
           $hid_img=$request->hid_img;
           //$doctor->avators=$hid_img;
           $updatefilename=$hid_img;
        }
        
        $doctor = Doctor::find($id);
        $doctor->avators=$updatefilename;
        $doctor->first_name = $request->company_name;
        $doctor->last_name='';
        $doctor->address = $request->company_address; 
        $doctor->email = $request->email;
        
        $doctor->mobile = $request->mobile_no;
        $doctor->company_regsitration_no = $request->company_regsitration_no;
        $doctor->doe=date("Y-m-d",strtotime($request->date_of_establishment));
        $doctor->state_id=$request->state_id;

        $doctor->city=$request->city;
        $doctor->pincode = $request->pincode;
        $doctor->type = 'C';
        $doctor->status = $request->inputStatus;
        
        $doctor->save();

        return redirect('/admin/company');

   }
   public function delete(Request $request,$id)
   {
      $doctor = Doctor::find($id);
      if($doctor->delete()) {
        //$request->session()->flash("message", "Deleted successfully");
        return redirect('/admin/company');
      }
   }
   public function changepassword(Request $request,$id)
   {
     $id = Doctor::find($id);
     return view('admin.company.change_password')->with('data',$id);
   }
   public function updatepassword(Request $request)
   {

       Validator::make($request->all(), [
          //'old_password' => 'required'. Auth::Doctor()->password,
          'old_password' => 'required',
          'new_password' => 'required|different:old_password',
          'confirm_password' => 'required|same:new_password'
          
      ])->validate();

        $doctor_id=$request->id;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        
        $doctors = Doctor::find($doctor_id);

        if($doctors) {

            if (Hash::check($old_password, $doctors->password)) { 

                  $doctors->password = bcrypt($new_password);
                  $doctors->save();
                   
                  $request->session()->flash("message", "Password Change successfully");
                  return back();
             }
            else {

                 
                $request->session()->flash("error_message", "The specified password does not match the database password");
                 return back();
            }
        }
        
   }
}
