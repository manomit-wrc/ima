<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Image;
use App\Banner;

class BannerController extends Controller
{
   public function index() {

		$banner_list = Banner::all();
		return view('admin.banner.index')->with('banner_list',$banner_list);
   } 

   public function add() {
   		return view('admin.banner.add');
   }

   public function store(Request $request) {
   		Validator::make($request->all(), [
          'name' => 'required|max:50',
          'short_description' => 'required|max:255',
          'full_description' => 'required',
          'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ])->validate();

   		if($request->hasFile('banner_image')) {
          $file = $request->file('banner_image') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath_1 = public_path().'/uploads/banner/thumb' ;
          $destinationPath_2 = public_path().'/uploads/banner/resize' ;

          $img = Image::make($file->getRealPath());

          $img->resize(100, 100, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath_1.'/'.$fileName);

          $img->resize(1349, 351, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath_2.'/'.$fileName);

          //original destination path
          $destinationPath = public_path().'/uploads/banner/' ;
          $file->move($destinationPath,$fileName);
        }
        else {
          $fileName = '';
        }

        $banner = new Banner();
        $banner->name = $request->name;
        $banner->short_description = $request->short_description;
        $banner->full_description = $request->full_description;
        $banner->banner_image = $fileName;
        $banner->save();

        $request->session()->flash("message", "Banner added successfully");
	    return redirect('/admin/banner');
   }

   public function edit($id) {
   		$banner_list = Banner::find($id);
   		return view('admin.banner.edit')->with('banner_list',$banner_list);
   }

   public function update(Request $request, $id) {
   		Validator::make($request->all(), [
          'name' => 'required|max:50',
          'short_description' => 'required|max:255',
          'full_description' => 'required',
          'banner_image' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ])->validate();

   		$banner_list = Banner::find($id);
   		if($request->hasFile('banner_image')) {
          $file = $request->file('banner_image') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          $destinationPath_1 = public_path().'/uploads/banner/thumb' ;
          $destinationPath_2 = public_path().'/uploads/banner/resize' ;

          $img = Image::make($file->getRealPath());

          $img->resize(100, 100, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath_1.'/'.$fileName);

          $img->resize(1349, 351, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath_2.'/'.$fileName);

          //original destination path
          $destinationPath = public_path().'/uploads/banner/' ;
          $file->move($destinationPath,$fileName);
        }
        else {
          $fileName = $banner_list->banner_image;
        }

        $banner_list->name = $request->name;
        $banner_list->short_description = $request->short_description;
        $banner_list->full_description = $request->full_description;
        $banner_list->banner_image = $fileName;
        $banner_list->save();

        $request->session()->flash("message", "Banner updated successfully");
	    return redirect('/admin/banner');
   }

   public function delete(Request $request, $id) {
   		$banner_list = Banner::find($id);
   		if($banner_list->delete()) {
   			$request->session()->flash("message", "Banner deleted successfully");
	    	return redirect('/admin/banner');
   		}
   }
}
