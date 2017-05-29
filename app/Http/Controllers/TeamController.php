<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Team;
use App\Designation;
use Validator;
use Image;

class TeamController extends Controller
{
    public function index() {
    	$teams = Team::all();
    	return view('admin.team.index')->with('team',$teams);
    }

    public function add() {
    	$designations = Designation::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
    	return view('admin.team.add')->with('designations',$designations);
    }

    public function store(Request $request) {
    	Validator::make($request->all(), [
          'first_name' => 'required|max:20',
          'last_name' => 'required|max:20',
          'email' => 'required|email|unique:teams,email',
          'address' => 'required',
          'mobile_no' => 'required|max:10|min:10|regex:/[0-9]{10}/',
          'serving_period' => 'required_with|regex:/(^[A-Za-z0-9- ]+$)+/',
          'avators' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'designation_id' => 'required',
          'status' => 'required'
      ])->validate();

      if($request->hasFile('avators')) {
          $file = $request->file('avators') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath = public_path().'/uploads/teams/thumb' ;

          $img = Image::make($file->getRealPath());

          $img->resize(150, 150, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath.'/'.$fileName);

          //original destination path
          $destinationPath = public_path().'/uploads/teams/' ;
          $file->move($destinationPath,$fileName);
        }
        else {
          $fileName = '';
        }

        $team = new Team();
        $team->first_name = $request->first_name;
        $team->last_name = $request->last_name;	
        $team->address = $request->address;
        $team->email = $request->email;
        $team->mobile_no = $request->mobile_no;
        $team->designation_id = $request->designation_id;
        $team->serving_period = $request->serving_period;
        $team->avators = $fileName;
        $team->status = $request->status;

        $team->save();

        $request->session()->flash("message", "Team member added successfully");
	      return redirect('/admin/team');
    }

    public function edit($id) {
    	$team = Team::with('designations')->where('id',$id)->get();
    	$designations = Designation::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
    	return view('admin.team.edit')->with(['team'=>$team,'designations'=>$designations]);
    }

    public function update(Request $request) {
    	Validator::make($request->all(), [
          'first_name' => 'required|max:20',
          'last_name' => 'required|max:20',
          'email' => 'required|email|unique:teams,email,'.$request->id,
          'address' => 'required',
          'mobile_no' => 'required|max:10|min:10|regex:/[0-9]{10}/',
          'serving_period' => 'required_with|regex:/(^[A-Za-z0-9- ]+$)+/',
          'avators' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'designation_id' => 'required',
          'status' => 'required'
      ])->validate();


      $team = Team::find($request->id);
      if($request->hasFile('avators')) {
          $file = $request->file('avators') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath = public_path().'/uploads/teams/thumb' ;

          $img = Image::make($file->getRealPath());

          $img->resize(150, 150, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath.'/'.$fileName);

          //original destination path
          $destinationPath = public_path().'/uploads/teams/' ;
          $file->move($destinationPath,$fileName);
        }
        else {
          $fileName = $team->avators;
        }

        
        $team->first_name = $request->first_name;
        $team->last_name = $request->last_name;	
        $team->address = $request->address;
        $team->email = $request->email;
        $team->mobile_no = $request->mobile_no;
        $team->designation_id = $request->designation_id;
        $team->serving_period = $request->serving_period;
        $team->avators = $fileName;
        $team->status = $request->status;

        $team->save();

        $request->session()->flash("message", "Team member updated successfully");
	    return redirect('/admin/team');
    }

    public function delete(Request $request, $id) {
    	$team = Team::find($id);
    	if($team->delete()) {
    		$request->session()->flash("message", "Team member deleted successfully");
	    	return redirect('/admin/team');
    	}
    }
}
