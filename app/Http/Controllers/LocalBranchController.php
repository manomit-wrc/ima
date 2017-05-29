<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LocalBranch;
use App\Designation;
use Validator;
use Image;

class LocalBranchController extends Controller
{
    public function index() {
    	$local_branch_list = LocalBranch::all();
    	return view('admin.local_branch.index')->with('local_branch_list',$local_branch_list);
    }

    public function add() {
    	$designations = Designation::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
    	return view('admin.local_branch.add')->with('designations',$designations);
    }

    public function store(Request $request) {
    	Validator::make($request->all(),[
    		'branch_name' => 'required|max:50',
    		'branch_head' => 'required|max:50',
    		'email_id' => 'required|email|unique:local_branches,email_id',
    		'mobile_no' => 'required|max:10|min:10|regex:/[0-9]{10}/',
    		'phone_no' => 'required|regex:/[0-9]{10}/',
    		'branch_address' => 'required',
    		'branch_image' => 'required_with|image|mimes:jpeg,jpg,png,gif|max:2048',
    		'designation_id' => 'required',
    		'status' => 'required'
    	])->validate();

    	if($request->hasFile('branch_image')) {
          $file = $request->file('branch_image') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath = public_path().'/uploads/local_branch/thumb' ;

          $img = Image::make($file->getRealPath());

          $img->resize(150, 150, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath.'/'.$fileName);

          //original destination path
          $destinationPath = public_path().'/uploads/local_branch/' ;
          $file->move($destinationPath,$fileName);
        }
        else {
          $fileName = '';
        }

        $local_branch = new LocalBranch();

        $local_branch->branch_name = $request->branch_name;
        $local_branch->branch_head = $request->branch_head;
        $local_branch->email_id = $request->email_id;
        $local_branch->mobile_no = $request->mobile_no;
        $local_branch->phone_no = $request->phone_no;
        $local_branch->branch_address = $request->branch_address;
        $local_branch->branch_image = $fileName;
        $local_branch->designation_id = $request->designation_id;
        $local_branch->status = $request->status;

        $local_branch->save();

        $request->session()->flash("message", "Local branch added successfully");
	    return redirect('/admin/local-branch');

    }

    public function edit($id) {
		$designations = Designation::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
		$local_branch_list = LocalBranch::find($id);
    	return view('admin.local_branch.edit')->with(['designations'=>$designations,'local_branch_list'=>$local_branch_list]);
    }

    public function update(Request $request, $id) {
    	Validator::make($request->all(),[
    		'branch_name' => 'required|max:50',
    		'branch_head' => 'required|max:50',
    		'email_id' => 'required|email|unique:local_branches,email_id,'.$id,
    		'mobile_no' => 'required|max:10|min:10|regex:/[0-9]{10}/',
    		'phone_no' => 'required|regex:/[0-9]{10}/',
    		'branch_address' => 'required',
    		'branch_image' => 'required_with|image|mimes:jpeg,jpg,png,gif|max:2048',
    		'designation_id' => 'required',
    		'status' => 'required'
    	])->validate();

    	$local_branch_list = LocalBranch::find($id);

    	if($request->hasFile('branch_image')) {
          $file = $request->file('branch_image') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath = public_path().'/uploads/local_branch/thumb' ;

          $img = Image::make($file->getRealPath());

          $img->resize(150, 150, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath.'/'.$fileName);

          //original destination path
          $destinationPath = public_path().'/uploads/local_branch/' ;
          $file->move($destinationPath,$fileName);
        }
        else {
          $fileName = $local_branch_list->branch_image;
        }

        

        $local_branch_list->branch_name = $request->branch_name;
        $local_branch_list->branch_head = $request->branch_head;
        $local_branch_list->email_id = $request->email_id;
        $local_branch_list->mobile_no = $request->mobile_no;
        $local_branch_list->phone_no = $request->phone_no;
        $local_branch_list->branch_address = $request->branch_address;
        $local_branch_list->branch_image = $fileName;
        $local_branch_list->designation_id = $request->designation_id;
        $local_branch_list->status = $request->status;

        $local_branch_list->save();

        $request->session()->flash("message", "Local branch updated successfully");
	    return redirect('/admin/local-branch');

    }

    public function delete(Request $request, $id) {
    	$local_branch_list = LocalBranch::find($id);
    	if($local_branch_list->delete()) {
    		$request->session()->flash("message", "Local branch deleted successfully");
	    	return redirect('/admin/local-branch');
    	}
    }
}
