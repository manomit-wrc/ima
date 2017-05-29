<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;

class DashboardController extends Controller
{
    public function __construct() {

    }
    public function index() {
    	
    	return view('admin.dashboard');
    	
    }
    public function profile() {
    	$user_details = User::find(Auth::guard('admin')->user()->id);
    	return view('admin.profile')->with('user_details',$user_details);
    }

    public function update_profile(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:32',
          'address' => 'required',
          'mobile' => 'required|regex:/[0-9]{10}/',
          'avators' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ])->validate();

    	$user_details = User::find(Auth::guard('admin')->user()->id);
    	
    	if($user_details) {

    		  if($request->hasFile('avators')) {
	          $file = $request->file('avators') ;

	          $fileName = time().'_'.$file->getClientOriginalName() ;

	          //thumb destination path
	           //thumb destination path
	            $thumbPath1 = public_path().'/uploads/profile/thumb_100_100' ;
	            $thumbPath2 = public_path().'/uploads/profile/thumb_25_25' ;
	            $img = Image::make($file->getRealPath());

	            $img->resize(100, 100, function ($constraint){
	                $constraint->aspectRatio();
	            })->save($thumbPath1.'/'.$fileName);


	            $img->resize(25, 25, function ($constraint){
	                $constraint->aspectRatio();
	            })->save($thumbPath2.'/'.$fileName);

	          //original destination path
	          $destinationPath = public_path().'/uploads/profile/' ;
	          $file->move($destinationPath,$fileName);
	        }
	        else {
	          $fileName = $user_details->avators;
	        }

	        $user_details->name = $request->name;
	        $user_details->address = $request->address;
	        $user_details->mobile = $request->mobile;
	        $user_details->avators = $fileName;
	        $user_details->save();
	        $request->session()->flash("message", "Profile updated successfully");
	        return redirect('/admin/profile');
    	}
        
        
        
    }

    public function organization(Request $request) {
    	$organization_details = \App\Organization::find(1);
    	return view('admin.organization')->with('organization_details',$organization_details);
    }

    public function update_organization(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:32',
          'address' => 'required',
          'phone' => 'required',
          'email' => 'required|email',
          'alternate_email' => 'required|email|different:email',
          'facebook_link' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
          'twitter_link' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
      ])->validate();

    	$organization_details = \App\Organization::find(1);
    	$organization_details->name = $request->name;
    	$organization_details->email = $request->email;
    	$organization_details->alternate_email = $request->alternate_email;
    	$organization_details->phone = $request->phone;
    	$organization_details->address = $request->address;
    	$organization_details->facebook_link = $request->facebook_link;
    	$organization_details->twitter_link = $request->twitter_link;

    	$organization_details->save();

    	$request->session()->flash("message", "Organization details updated successfully");
	    return redirect('/admin/organization');

    }
}
