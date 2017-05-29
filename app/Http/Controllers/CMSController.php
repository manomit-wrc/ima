<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CMS;
use Validator;

class CMSController extends Controller
{
    public function index() {
    	$cms_list = CMS::all();
    	return view('admin.cms.index')->with('cms_list',$cms_list);
    }

    public function add() {
    	return view('admin.cms.add');
    }

    public function store(Request $request) {
    	Validator::make($request->all(),[
    		'title' => 'required|max:100',
    		'short_description' => 'required',
    		'full_description' => 'required',
    		'status' => 'required'
    	])->validate();

    	$cms = new CMS();
    	$cms->title = $request->title;
    	$cms->slug = str_slug($request->title,"-");
    	$cms->short_description = $request->short_description;
    	$cms->full_description = $request->full_description;
    	$cms->status = $request->status;

    	$cms->save();
    	$request->session()->flash("message", "Added successfully");
	    return redirect('/admin/cms');
    }

    public function edit($id) {
    	$cms_list = CMS::find($id);
    	return view('admin.cms.edit')->with('cms_list',$cms_list);
    }

    public function update(Request $request, $id) {
    	Validator::make($request->all(),[
    		'title' => 'required|max:100',
    		'short_description' => 'required',
    		'full_description' => 'required',
    		'status' => 'required'
    	])->validate();

    	$cms = CMS::find($id);
    	$cms->title = $request->title;
    	$cms->slug = str_slug($request->title,"-");
    	$cms->short_description = $request->short_description;
    	$cms->full_description = $request->full_description;
    	$cms->status = $request->status;

    	$cms->save();

    	$request->session()->flash("message", "Updated successfully");
	    return redirect('/admin/cms');
    }

    public function delete(Request $request, $id) {
    	$cms = CMS::find($id);
    	if($cms->delete()) {
    		$request->session()->flash("message", "Deleted successfully");
	    	return redirect('/admin/cms');
    	}
    }
}
