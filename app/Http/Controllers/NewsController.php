<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Tag;
use Validator;

class NewsController extends Controller
{
    public function index() {
    	$news = News::all();
    	return view('admin.news.index')->with('news',$news);
    }

    public function add() {
    	$tags = Tag::get()->pluck('tag_name','id')->toArray();
    	return view('admin.news.add')->with('tags',$tags);
    }

    public function store(Request $request) {
    	Validator::make($request->all(),[
    		'title' => 'required|max:255',
    		'description' => 'required',
    		'published_date' => 'required|date_format:d-m-Y|after:tomorrow',
    		'tag_id' => 'required|array'
    	])->validate();

    	$news = new News();
    	$news->title = $request->title;
    	$news->description = $request->description;
    	$news->published_date = date("Y-m-d",strtotime($request->published_date));
    	$news->status = $request->status;

    	$news->save();

    	$news->tags()->attach($request->tag_id);

    	$request->session()->flash("message", "News addedd successfully");
        return redirect('/admin/news');
    }

    public function edit($id) {
    	$news = News::find($id);
    	$news_tag = News::with('tags')->where('id',$id)->get()->toArray();
    	$tags = Tag::get()->pluck('tag_name','id')->toArray();

    	foreach ($news_tag[0]['tags'] as $key => $value) {
          $tags_array[] = $value['id'];
        }
        return view('admin.news.edit')->with(['news'=>$news,'tags'=>$tags,'tags_array'=>$tags_array]);
    }

    public function update(Request $request, $id) {
    	Validator::make($request->all(),[
    		'title' => 'required|max:255',
    		'description' => 'required',
    		'published_date' => 'required|date_format:d-m-Y|after:tomorrow',
    		'tag_id' => 'required|array'
    	])->validate();

    	$news = News::find($id);
    	$news->title = $request->title;
    	$news->description = $request->description;
    	$news->published_date = date("Y-m-d",strtotime($request->published_date));
    	$news->status = $request->status;

    	$news->save();

    	$news->tags()->wherePivot('news_id', '=', $id)->detach();
        $news->tags()->attach($request->tag_id);

        $request->session()->flash("message", "News updated successfully");
        return redirect('/admin/news');
    }

    public function delete(Request $request, $id) {
    	$news = News::find($id);
    	if($news->delete()) {
    		$news->tags()->wherePivot('news_id', '=', $id)->detach();
    		$request->session()->flash("message", "News deleted successfully");
        	return redirect('/admin/news');
    	}
    }
}
