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
                $news_array[] = array('title'=>$value['title'],'description'=>substr($value['description'], 0,50)." ..",'published_date'=>date('d-m-Y',strtotime($value['published_date'])),'news_id'=>$value['id']);
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
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            Doctor::create($input);
            return response()->json(['error' => false,
                'message' => "Successfully registered. Please check your email to activate yout account.",
                'code' => 200]);
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
        return response()->json(['msg' => 'Successfully Login','status_code'=>200,'token'=>$token]);
        
    }

    public function getAuthUser(Request $request) {
        
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
}
