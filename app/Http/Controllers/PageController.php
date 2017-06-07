<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Team;
use App\Designation;
use App\News;
use App\Event;
use Validator;
use App\Doctor;
use JWTAuth;
use JWTAuthException;
use Config;
use Image;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationEmail;
use App\Mail\NewPasswordEmail;

class PageController extends Controller
{
    public function home_content() {
    	
    	try {
            $banner_list = Banner::all();
            $news = News::where('status','1')->get()->toArray();
            $events = Event::where('status','1')->get()->toArray();
            $team_list = Team::with('designations')->where('status','1')->get()->toArray();
            $teams = [];
            $news_array = [];
            $events_array = [];
            $i = 0;
            $k = 0;
            
            foreach ($team_list as $key => $value) {

                $teams[$k]['team_list'][$i] = array('name'=>$value['first_name']." ".$value['last_name'],'image'=>$value['avators'],'designation_name' => $value['designations']['name']);
                if(($i+1) % 3 == 0) {
                    $k++;
                    $i = -1;
                }
                $i++;
            }

            foreach ($news as $key => $value) {
                $news_array[] = array('title'=>$value['title'],'description'=>substr($value['description'], 0,50)." ..",'published_date'=>date('d-m-Y',strtotime($value['published_date'])),'news_id'=>$value['id'],'slug'=>str_slug($value['title'],"-"));
            }  

            foreach ($events as $key => $value) {
                $events_array[] = array('name'=>$value['name'],'description'=>substr($value['description'], 0,50)." ..",'event_date'=>date('d-m-Y',strtotime($value['event_date'])),'event_id'=>$value['id']);
            }           
    		return response()->json(['banners'=>$banner_list,'teams'=>$teams,'status_code'=>200,'news'=>$news_array,'events'=>$events_array]);
    	}
    	catch(Exception $e) {
    		return response()->json(['status_code'=>500]);
    	}
    }

    public function registration(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'email' => 'required|email|unique:doctors,email',
            'mobile' => 'required|max:10|min:10|regex:/[0-9]{10}/',
            'password' => 'required|max:32|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
            $doctor = new Doctor();
            $doctor->first_name = $request->first_name;
            $doctor->last_name = $request->last_name;
            $doctor->email = $request->email;
            $doctor->mobile = $request->mobile;
            $doctor->password = bcrypt($request->password);
            $doctor->address = '';
            $doctor->state_id = 24;
            
            $doctor->active_token = str_replace("/","",Hash::make(str_random(30)));
            $doctor->status = "0";
            
            if($doctor->save()) {
                $activation_link = config('app.url').'activate/'.$doctor->active_token."/".time();
                Mail::to($request->input('email'))->send(new RegistrationEmail($activation_link));
                return response()->json(['error' => false,
                'message' => "Successfully registered. Please check your email to activate yout account.",
                'code' => 200]);
            }
            
        }
    }

     public function login(Request $request){
        Config::set('tymon.jwt.provider.jwt', '\App\Doctor');
        $credentials = $request->only('email', 'password');
        $token = null;
        try {

           if (!$token = JWTAuth::attempt($credentials)) {
            
            return response()->json(['msg' => 'Invalid Email Or Password','status_code'=>404]);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['msg' => 'Failed to create token','status_code'=>500]);
        }
        $user = JWTAuth::toUser($token);
        if($user->status == 0) {
            return response()->json(['msg' => 'Account Not Activated.','status_code'=>404]);
        }
        else {
            return response()->json(['msg' => 'Successfully Login','status_code'=>200,'token'=>$token]);
        }
        
        
    }

    public function getAuthUser(Request $request) {
        
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

    public function get_state_list() {
        $state_list = \App\State::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
        return response()->json(['state_list' => $state_list]);
    }

    public function update_profile(Request $request) {
        $doctors = Doctor::find($request->doctor_id);
        if($doctors) {
            $doctors->first_name = $request->first_name;
            $doctors->last_name = $request->last_name;
            $doctors->email = $request->email;
            $doctors->mobile = $request->mobile;
            $doctors->sex = $request->sex;
            $doctors->state_id = $request->state_id;
            $doctors->city = $request->city;
            $doctors->pincode = $request->pincode;
            $doctors->dob = date('Y-m-d',strtotime($request->dob));
            $doctors->license = $request->license;
            $doctors->biography = $request->biography;

            $doctors->save();
            
            return response()->json(['status_code'=>200]);
        }
        else {
            return response()->json(['status_code'=>500]);
        }
    }

    public function update_profile_photo(Request $request) {
        if($request->hasFile('avators')) {
        $file = $request->file('avators') ;

        $fileName = time().'_'.$file->getClientOriginalName() ;

        //thumb destination path
        $destinationPath = public_path().'/uploads/doctors/thumb' ;

        $img = Image::make($file->getRealPath());

        $img->resize(200, 200, function ($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$fileName);

        //original destination path
        $destinationPath = public_path().'/uploads/doctors/' ;
        $file->move($destinationPath,$fileName);
        $doctors = Doctor::find($request->doctor_id);
        if($doctors) {
            $doctors->avators = $fileName;
            $doctors->save();
            return response()->json(['status_code'=>200]);
        }
        else {
            return response()->json(['status_code'=>404]);
        }        

      }
      else {
        return response()->json(['status_code'=>500]);
      }
    }

    public function update_password(Request $request) {
        $doctor_id = $request->doctor_id;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        
        $doctors = Doctor::find($request->doctor_id);
        
        if($doctors) {

            if (Hash::check($old_password, $doctors->password)) { 
                $doctors->password = bcrypt($new_password);

                $doctors->save();

                return response()->json(['error' => true,
                'message' => "Password Change Successfully",
                'code' => 200]);                
            }
            else {
                return response()->json(['error' => false,
                'message' => "Old Password Not Matched",
                'code' => 403]);
            }
        }
        else {
            return response()->json(['error' => false,
            'message' => "Password not changed.Please try again",
            'code' => 500]);
        }
    }

    public function categories() {
        $categories = \App\Category::all();
        if($categories) {
            foreach ($categories as $value) {
                $cat_arr[] = array('label'=>$value->name,'value'=>$value->id);
            }
            return response()->json(['error' => false,
                'categories' => $cat_arr,
                'code' => 200]);
        }
        else {
            return response()->json(['error' => true,
                'categories' => array(),
                'code' => 404]);
        }
    }

    public function submit_journal(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:40',
            'description' => 'required',
            'published_date' => 'required|date_format:d-m-Y|before_or_equal:today',
            'category_id' => 'required',
            'journal_file' => 'required|mimes:pdf|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
            if($request->hasFile('journal_file')) {
            $file = $request->file('journal_file') ;

            $fileName = time().'_'.$file->getClientOriginalName() ;

            $destinationPath = public_path().'/uploads/doctors/journal/' ;
            $file->move($destinationPath,$fileName);
            
            $journal = new \App\Journal();

            $journal->title = $request->title;
            $journal->description = $request->description;
            $journal->published_date = date('Y-m-d',strtotime($request->published_date));
            $journal->category_id = $request->category_id;
            $journal->doctor_id = $request->doctor_id;
            $journal->journal_file = $fileName;

            $journal->save();

            return response()->json(['error' => false,
            'message' => 'Journal uploaded successfully',
            'code' => 200]);
            
                

          }
          else {
            return response()->json(['error' => true,
                'message' => 'Something not right. Try again',
                'code' => 500]);
          }
        }
    }

    public function get_news(Request $request) {
        $news_id = $request->news_id;
        $news_slug = $request->slug;
        $news_arr = array();
        $tags_arr = array();
        $news_details = \App\News::with('tags')->where('id',$news_id)->get()->toArray();
        
        foreach ($news_details as $value) {
           $news_arr[] = array('title'=>$value['title'],'description'=>$value['description'],'published_date'=>date('d-m-Y',strtotime($value['published_date'])));
           foreach ($value['tags'] as  $value1) {
               $tags_arr[] = array('tag_name'=>$value1['tag_name'],'tag_id'=>$value1['id']);
           }

        }

        return response()->json(['tags_arr' => $tags_arr,
                'news_arr' => $news_arr]);
    }

    public function check_user_email(Request $request) {
        $email = $request->email;
        $check_email = Doctor::where('email',$email)->get();
        if($check_email) {
            //return response()->json(['msg' => 'Invalid Email Or Password','status_code'=>404]);
            //return response()->json(['msg' => 'Email ID  Exists','status_code'=>200]);
            $random_password = str_random(8);
            $hashed_random_password = Hash::make($random_password);
            
            
            Doctor::where('email',$email)->update(['password' => $hashed_random_password]);

            Mail::to($request->input('email'))->send(new NewPasswordEmail($random_password));
            return response()->json(['error' => false,
            'message' => "New generated password is sent to your registered email.",
            'code' => 200]);
        }
        else {
            return response()->json(['msg' => 'Email ID Not Exists','status_code'=>404]);
        }
    }

    public function activate_account(Request $request) {
        $start_time = time();
        $time_diff = ($start_time-$request->active_time)/60/1000;
        if(number_format((float)$time_diff, 2, '.', '') > 1440) {
          $message = "Activation link is expired";
        }
        else {
          $doctor_details = Doctor::where('active_token',$request->active_token)->first();
          if($doctor_details) {
            if($doctor_details->status == "0") {
              $doctor_details->status = "1";
              $doctor_details->save();
              $message = "Your account has been activated. Please click on login to further process.";
            }
            else {
              $message = "Account already activated";
            }
          }
          else {
            $message = "Invalid activation token";
          }
        }

        return response()->json(['msg' => $message,'status_code'=>200]);
    }
}
