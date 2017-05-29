<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Validator;

class TagController extends Controller
{
    public function index() {
    	$tags = Tag::all();
    	return view('admin.tag.index')->with('tags',$tags);
    }

    public function add() {
    	return view('admin.tag.add');
    }

    public function store(Request $request) {
    	Validator::make($request->all(), [
          'tag_name' => 'required|max:40|unique:tags',
          'status' => 'required'
      ])->validate();

    	$tag = new Tag();
    	$tag->tag_name = $request->tag_name;
    	$tag->status = $request->status;
    	$tag->save();

    	$request->session()->flash("message", "Tag added successfully");
	    return redirect('/admin/tag');
    }

    public function edit($id) {
    	$tag_list = Tag::find($id);
    	return view('admin.tag.edit')->with('tag_list',$tag_list);
    }

    public function update(Request $request) {
    	Validator::make($request->all(), [
          'tag_name' => 'required|max:40|unique:tags,tag_name,'.$request->id,
          'status' => 'required'
      ])->validate();

    	$tag = Tag::find($request->id);
    	$tag->tag_name = $request->tag_name;
    	$tag->status = $request->status;
    	$tag->save();

    	$request->session()->flash("message", "Tag updated successfully");
	    return redirect('/admin/tag');
    }
    public function delete(Request $request,$id) {
    	$tag = Tag::find($id);
    	if($tag->delete()) {
    		$request->session()->flash("message", "Tag deleted successfully");
	    	return redirect('/admin/tag');
    	}
    }
}
