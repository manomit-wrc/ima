<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\EventCategory;

class EventCategoryController extends Controller
{
    public function index() {

    	$event_category = EventCategory::all();
    	return view('admin.event_category.index')->with('event_category',$event_category);
    }

    public function add() {
    	return view('admin.event_category.add');
    }

    public function store(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:40|unique:event_categories',
          'status' => 'required'
      ])->validate();

    	$event_category = new EventCategory();
    	$event_category->name = $request->name;
    	$event_category->status = $request->status;
    	$event_category->save();

    	$request->session()->flash("message", "Event category added successfully");
	    return redirect('/admin/event-category');
    }

    public function edit($id) {
    	$event_category = EventCategory::find($id);
    	return view('admin.event_category.edit')->with('event_category',$event_category);
    }

    public function update(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:40|unique:event_categories,name,'.$request->id,
          'status' => 'required'
      ])->validate();

    	$event_category = EventCategory::find($request->id);
    	$event_category->name = $request->name;
    	$event_category->status = $request->status;
    	$event_category->save();

    	$request->session()->flash("message", "Event category updated successfully");
	    return redirect('/admin/event-category');
    }
    public function delete(Request $request,$id) {
    	$event_category = EventCategory::find($id);
    	if($event_category->delete()) {
    		$request->session()->flash("message", "Event category deleted successfully");
	    	return redirect('/admin/event-category');
    	}
    }
}
