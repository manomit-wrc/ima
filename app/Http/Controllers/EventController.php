<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventCategory;
use Validator;
use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\Input;
use App\EventGallery;
use File;

class EventController extends Controller
{
	protected $image;
	public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }
    public function index() {
    	$events = Event::all();
    	return view('admin.event.index')->with('events',$events);
    }

    public function add() {
    	$event_categories = EventCategory::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
    	return view('admin.event.add')->with('event_categories',$event_categories);
    }

    public function store(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:50',
          'event_category_id' => 'required',
          'event_venue' => 'required',
          'event_date' => 'required|date_format:d-m-Y|after:tomorrow',
          'description' => 'required',
          'status' => 'required'
      ])->validate();


        $event = new Event();
        $event->name = $request->name;
        $event->event_category_id = $request->event_category_id;	
        $event->event_venue = $request->event_venue;
        $event->event_date = date("Y-m-d",strtotime($request->event_date));
        $event->description = $request->description;
        $event->status = $request->status;
        
        $event->save();

        $request->session()->flash("message", "Event added successfully");
	    return redirect('/admin/event');
    }

    public function edit($id) {
    	$event = Event::with('event_categories')->where('id',$id)->get();
    	$event_categories = EventCategory::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
    	return view('admin.event.edit')->with(['event'=>$event,'event_categories'=>$event_categories]);
    }

    public function update(Request $request) {
    	Validator::make($request->all(), [
          'name' => 'required|max:50',
          'event_category_id' => 'required',
          'event_venue' => 'required',
          'event_date' => 'required|date_format:d-m-Y|after:tomorrow',
          'description' => 'required',
          'status' => 'required'
      ])->validate();


      	$event = Event::find($request->id);
      
        $event->name = $request->name;
        $event->event_category_id = $request->event_category_id;	
        $event->event_venue = $request->event_venue;
        $event->event_date = date("Y-m-d",strtotime($request->event_date));
        $event->description = $request->description;
        $event->status = $request->status;
        
        $event->save();

        $request->session()->flash("message", "Event updated successfully");
	    return redirect('/admin/event');
    }

    public function delete(Request $request, $id) {
    	$event = Event::find($id);
    	if($event->delete()) {
    		$request->session()->flash("message", "Event deleted successfully");
	    	return redirect('/admin/event');
    	}
    }

    public function gallery($id) {
    	return view('admin.event.gallery')->with('id',$id);
    }

    public function store_gallery(Request $request) {
    	$photo = Input::all();
        $response = $this->image->upload($photo,$request->id);
        return $response;
    }

    public function get_gallery($id) {

    	$images = EventGallery::where('event_id',$id)->get(['original_name', 'filename']);

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'server' => $image->filename,
                'size' => File::size(public_path('uploads/event/gallery/original/' . $image->filename))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }

    public function remove_gallery_image(Request $request) {
    	$filename = $request->file_name;
    	$event_id = $request->event_id;
        if(!$filename)
        {
            return 0;
        }
        $response = $this->image->delete( $filename,$event_id );
        return $response;
    }
}
