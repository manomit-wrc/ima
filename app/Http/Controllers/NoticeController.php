<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Image;
use App\Notice;

class NoticeController extends Controller
{
    public function index() {
    	$notices = Notice::all();
    	return view('admin.notice.index')->with('notices',$notices);
    }

    public function add() {
    	return view('admin.notice.add');
    }

    public function store(Request $request) {
    	Validator::make($request->all(),[
    		'subject' => 'required|max:100',
    		'published_date' => 'required|date_format:d-m-Y|after:tomorrow',
    		'file_name' => 'required|mimes:pdf|max:100000'
    	])->validate();

    	if($request->hasFile('file_name')) {
    		$file = $request->file('file_name') ;

          	$pdfFile = time().'_'.$file->getClientOriginalName().".".$file->getClientOriginalExtension();
        	$destinationPath = public_path().'/uploads/notice/' ;
          	$file->move($destinationPath,$pdfFile);
    	}
    	else {
          $pdfFile = '';
        }

        $notice = new Notice();
        $notice->subject = $request->subject;
        $notice->published_date = date("Y-m-d",strtotime($request->published_date));
        $notice->file_name = $pdfFile;

        $notice->save();
        $request->session()->flash("message", "Notice added successfully");
	    return redirect('/admin/notice');
    }

    public function edit($id) {
    	$notices = Notice::find($id);
    	return view('admin.notice.edit')->with('notices',$notices);
    }

    public function update(Request $request, $id) {
    	Validator::make($request->all(),[
    		'subject' => 'required|max:100',
    		'published_date' => 'required|date_format:d-m-Y|after:tomorrow',
    		'file_name' => 'required_with|mimes:pdf|max:100000'
    	])->validate();

    	$notices = Notice::find($id);

    	if($request->hasFile('file_name')) {
    		$file = $request->file('file_name') ;

          	$pdfFile = time().'_'.$file->getClientOriginalName().".".$file->getClientOriginalExtension();
        	$destinationPath = public_path().'/uploads/notice/' ;
          	$file->move($destinationPath,$pdfFile);
    	}
    	else {
          $pdfFile = $notices->file_name;
        }

        $notices->subject = $request->subject;
        $notices->published_date = date("Y-m-d",strtotime($request->published_date));
        $notices->file_name = $pdfFile;

        $notices->save();
        $request->session()->flash("message", "Notice updated successfully");
	    return redirect('/admin/notice');
    }

    public function delete(Request $request, $id) {
    	$notices = Notice::find($id);
    	if($notices->delete()) {
    		$request->session()->flash("message", "Notice deleted successfully");
	    	return redirect('/admin/notice');
    	}
    }
}
