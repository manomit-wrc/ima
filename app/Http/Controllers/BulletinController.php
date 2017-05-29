<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bulletin;
use Validator;
use Image;

class BulletinController extends Controller
{
    public function index() {
    	$bulletin_list = Bulletin::all();
    	return view('admin.bulletin.index')->with('bulletin_list',$bulletin_list);
    }

    public function add() {
    	return view('admin.bulletin.add');
    }

    public function store(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:50',
          'bulletin_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'bulletin_file' => 'required|mimes:pdf|max:100000'
      ])->validate();

    	if($request->hasFile('bulletin_image')) {
          $file = $request->file('bulletin_image') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath_1 = public_path().'/uploads/bulletin/thumb' ;
          

          $img = Image::make($file->getRealPath());

          $img->resize(150, 150, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath_1.'/'.$fileName);

          
        }
        else {
          $fileName = '';
        }

        if($request->hasFile('bulletin_file')) {
        	$file = $request->file('bulletin_file') ;

          	$pdfFile = time().'_'.$file->getClientOriginalName().".".$file->getClientOriginalExtension();
        	$destinationPath = public_path().'/uploads/bulletin/' ;
          	$file->move($destinationPath,$pdfFile);
        }
        else {
        	$pdfFile = '';
        }

        $bulletin = new Bulletin();
        $bulletin->name = $request->name;
        $bulletin->bulletin_image = $fileName;
        $bulletin->bulletin_file = $pdfFile;
        $bulletin->status = $request->status;

        $bulletin->save();

        $request->session()->flash("message", "Bulletin added successfully");
	    return redirect('/admin/bulletin');
    }

    public function edit($id) {
    	$bulletin_list = Bulletin::find($id);
    	return view('admin.bulletin.edit')->with('bulletin_list',$bulletin_list);
    }

    public function update(Request $request, $id) {
    	Validator::make($request->all(), [
          'name' => 'required|max:50',
          'bulletin_image' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'bulletin_file' => 'required_with|mimes:pdf|max:100000'
      ])->validate();

    	$bulletin_list = Bulletin::find($id);

    	if($request->hasFile('bulletin_image')) {
          $file = $request->file('bulletin_image') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath_1 = public_path().'/uploads/bulletin/thumb' ;
          

          $img = Image::make($file->getRealPath());

          $img->resize(150, 150, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath_1.'/'.$fileName);

          
        }
        else {
          $fileName = $bulletin_list->bulletin_image;
        }

        if($request->hasFile('bulletin_file')) {
        	$file = $request->file('bulletin_file') ;

          	$pdfFile = time().'_'.$file->getClientOriginalName().".".$file->getClientOriginalExtension();
        	$destinationPath = public_path().'/uploads/bulletin/' ;
          	$file->move($destinationPath,$pdfFile);
        }
        else {
        	$pdfFile = $bulletin_list->bulletin_file;
        }

        
        $bulletin_list->name = $request->name;
        $bulletin_list->bulletin_image = $fileName;
        $bulletin_list->bulletin_file = $pdfFile;
        $bulletin_list->status = $request->status;

        $bulletin_list->save();

        $request->session()->flash("message", "Bulletin updated successfully");
	    return redirect('/admin/bulletin');
    }

    public function delete(Request $request, $id) {
    	$bulletin_list = Bulletin::find($id);
    	if($bulletin_list->delete()) {
    		$request->session()->flash("message", "Bulletin deleted successfully");
	    	return redirect('/admin/bulletin');
    	}
    }
}
