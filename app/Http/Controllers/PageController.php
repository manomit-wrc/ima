<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Team;
use App\Contact;
use App\Designation;
use App\News;
use App\Organization;
use App\Event;
use App\LocalBranch;
use Validator;
use App\Doctor;
use App\Drug;
use App\Comment;
use App\State;
use App\CMS;
use App\Qualification;
use JWTAuth;
use JWTAuthException;
use Config;
use Image;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationEmail;
use App\Mail\NewPasswordEmail;
use App\Mail\ContactEmail;

class PageController extends Controller
{
    private $imageName;
    private $videoName;

    public function __construct() {
        $this->imageName = '';
        $this->videoName = '';
    }
    public function home_content() {
    	
    	try {
            $banner_list = Banner::all();
            $news = News::where('status','1')->get()->toArray();
            $events = Event::where('status','1')->get()->toArray();
            $team_list = Team::with('designations')->where('status','1')->get()->toArray();
            $testimonial_list = Doctor::with('states')->where('status','1')->whereNotNull('testimonial')->get()->toArray();

            $teams = [];
            $news_array = [];
            $events_array = [];
            $testimonial_array = [];
            $i = 0;
            $k = 0;
            $j=0;
            $h=0;
            foreach ($team_list as $key => $value) {
                
                $teams[$k]['team_list'][$i] = array('name'=>$value['first_name']." ".$value['last_name'],'image'=>$value['avators'],'designation_name' => $value['designations']['name']);
                if(($i+1) % 3 == 0) {
                    $k++;
                    $i = -1;
                }
                $i++;
            }
             
            foreach($testimonial_list as $key => $value) {
                 if(file_exists( public_path() . '/uploads/doctors/thumb/'.$value['avators']) && $value['avators']) {
                    $avators =  '/uploads/doctors/thumb/'.$value['avators'];
                } else {
                    $avators =  '/uploads/doctors/noimage_user.jpg';
                }
                $testimonial_array[$h]['testimonial_list'][$j] = array('doctorname'=>$value['first_name']." ".$value['last_name'],'image'=>$avators,'testimonial' => $value['testimonial'],'city'=>$value['city'],'state'=>$value['states']['name']);
                if(($j+1) % 3 == 0) {
                    $h++;
                    $j = -1;
                }
                $j++;
            }

            

            foreach ($news as $key => $value) {
                $news_array[] = array('title'=>$value['title'],'description'=>substr($value['description'], 0,50)." ..",'published_date'=>date('d-m-Y',strtotime($value['published_date'])),'news_id'=>$value['id'],'slug'=>str_slug($value['title'],"-"));
            }  

            foreach ($events as $key => $value) {
                $events_array[] = array('name'=>$value['name'],'description'=>substr($value['description'], 0,50)." ..",'event_date'=>date('d-m-Y',strtotime($value['event_date'])),'event_id'=>$value['id']);
            }           
    		return response()->json(['banners'=>$banner_list,'teams'=>$teams,'status_code'=>200,'news'=>$news_array,'events'=>$events_array,'testimonialdata'=>$testimonial_array]);
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

    public function contact_save(Request $request) {
       
         $validator = Validator::make($request->all(),[
            'firstname' => 'required|max:40',
            'lastname' => 'required|max:40',
            'email_id' => 'required|email',
            'phone' => 'required|max:10|min:10|regex:/[0-9]{10}/',
            'comment' => 'required|max:200|min:6'
        ]);
        
        $organization=Organization::all();

        //$contact = Contact::all();
        
        $emailto=$organization[0]['email'];
        $first_name=$request->firstname;
        $emailfrom=$request->email_id;
        $comment=$request->comment;
        //echo $first_name.'-'.$emailfrom.'-'.$comment.'-'.$emailto;
        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
            $contact = new Contact();
            $contact->firstname = $request->firstname;
            $contact->lastname = $request->lastname;
            $contact->email = $request->email_id;
            $contact->phone = $request->phone;
            $contact->comment =$request->comment;
            //$contact->save();
            
            
           if($contact->save()) {
            Mail::to($emailto)->send(new ContactEmail($first_name,$comment,$request->input('email_id')));
            return response()->json(['error' => false,
            'message' => "Mail Send Successfully.",
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

    public function get_speciality_list() {
        $speciality_list = \App\Specialist::where('status','1')->orderBy('specialist_name')->get()->pluck('specialist_name','id')->toArray();
        return response()->json(['speciality_list' => $speciality_list]);
    }

    public function get_qualification_list() {
        $qualification_list = \App\Qualification::where('status','1')->orderBy('qualification_name')->get()->pluck('qualification_name','id')->toArray();
        return response()->json(['qualification_list' => $qualification_list]);
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
            $doctors->address = $request->address;
            $doctors->testimonial = $request->testimonial;
            $doctors->hospital_name = $request->hospital_name;
            $doctors->doj =date('Y-m-d',strtotime($request->doj));
            $doctors->specialist_id = $request->speciality_id;

            $doctors->save();
            
            return response()->json(['status_code'=>200,'message'=>'Profile updated successfully']);
        }
        else {
            return response()->json(['status_code'=>500,'message'=>'Please try again']);
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
        $user = JWTAuth::toUser($request->header('token'));
        $doctors = Doctor::find($user->id);
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

    public function medical_category() {
        $departments = \App\Department::all();
        if($departments) {
            foreach ($departments as $value) {
                $cat_arr[] = array('label'=>$value->name,'value'=>$value->id);
            }
            return response()->json(['error' => false,
                'departments' => $cat_arr,
                'code' => 200]);
        }
        else {
            return response()->json(['error' => true,
                'departments' => array(),
                'code' => 404]);
        }
    }

    public function certificates() {
         $qualification_list = \App\Qualification::where('status','1')->orderBy('qualification_name')->get()->pluck('qualification_name','id')->toArray();
        return response()->json(['qualification_list' => $qualification_list]);
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

    public function submit_doctorcertificate(Request $request) {
        
       

        $validator = Validator::make($request->all(),[
            'payment' => 'required|max:7',
            'qualification_id' => 'required',
            'payment_date' => 'required|date_format:Y-m-d|before_or_equal:today',
            //'payment_date' => 'required|date_format:d-m-Y|before_or_equal:today',
           
            'doctor_file' => 'required',
            'doctor_file.*' => 'mimes:jpg,jpeg,pdf,png'
        ],[
            'payment.required' => 'Please enter payment',
            'payment.max:7' => 'Maximum 7 digits',
            'qualification_id.required' => 'Please select qualification',
            'payment_date.required' => 'Please enter payment date',
            'payment_date.date_format:d-m-Y' => 'Payment date must be valid date',
            'doctor_file.required' => 'Please upload certificate',
            'doctor_file.*' => 'Must be image file or pdf file'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
 
            //$doctor_id = $request->doctor_id;
            //echo $doctor_id;die();
            $filedata=array();
            //$filedata=$request->file('doctor_file');
            /*echo "<pre>";
            print_r($filedata);
            echo "</pre>";die();*/

            if($request->hasFile('doctor_file')) {
                foreach ($request->file('doctor_file') as $key => $value) {
                    

                    $fileName = time().'_'.$value->getClientOriginalName() ;

                    $destinationPath = public_path().'/uploads/doctors/qualification/';
                    $value->move($destinationPath,$fileName);

                    $filedata[]=$fileName;
                }
            
            
             //$a=$request->payment_type;
             //echo $a;die();

            $doctors =  Doctor::find($request->doctor_id);
            
            $doctors->payment = $request->payment;
            $doctors->date_of_payment =date('Y-m-d',strtotime($request->payment_date));
            $doctors->certificate = implode(',',$filedata);
            
            $doctors->payment_type = $request->payment_type;
            $doctors->bank_name = $request->bank_name;
            $doctors->branch_name = $request->branch_name;
            $doctors->cheque_no = $request->cheque_no;

            $doctors->save();
            $doctors->doctor_qualifications()->wherePivot('doctor_id', '=', $request->doctor_id)->detach();
            $doctors->doctor_qualifications()->attach(explode(",", $request->qualification_id));

            return response()->json(['error' => false,
            'message' => 'Certificate uploaded successfully',
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

     public function get_events(Request $request) {
        $events_id = $request->events_id;
        $events_slug = $request->slug;
        $events_arr = array();
        
        $events_details = \App\Event::find($events_id);
        return response()->json(['events_arr'=> $events_details]);
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

    public function news_list() {
        $news = \App\News::paginate(6);
        
        return response()->json(['news_item' => $news,'status_code'=>200]);
    }

    public function events_list() {
        $event = \App\Event::paginate(6);
        
        return response()->json(['events_item' => $event,'status_code'=>200]);

    }
    public function contact_us() {
        $contact = \App\Organization::all();
        return response()->json(['contact_item' => $contact,'status_code'=>200]);

    }
    public function local_branch() {
        //$localbranch = \App\LocalBranch::all();
         $localbranch = \App\LocalBranch::with('designations')->get();
         return response()->json(['branch_item' => $localbranch,'status_code'=>200]);

    }
    
    public function journal_list(Request $request) {
        $doctor_id = $request->doctor_id;
        $journal_details = Doctor::with('journal.categories')->where('id',$doctor_id)->get()->toArray();
        
        return response()->json(['journals' => $journal_details]);

    }

    public function journal_details(Request $request) {
        $journal_id = $request->journal_id;
        $journal_details = \App\Journal::find($journal_id);
        return response()->json(['journal_details' => $journal_details]);
    }

    public function update_journal(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:40',
            'description' => 'required',
            'published_date' => 'required|date_format:d-m-Y|before_or_equal:today',
            'category_id' => 'required',
            'journal_file' => 'required_with|mimes:pdf|max:100000'
        ]);
        $journal = \App\Journal::find($request->journal_id);

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
          }
          else {
            $fileName = $journal->journal_file;
            
          }

         $journal->title = $request->title;
         $journal->description = $request->description;
         $journal->published_date = date('Y-m-d',strtotime($request->published_date));
         $journal->category_id = $request->category_id;
         $journal->doctor_id = $request->doctor_id;
         $journal->journal_file = $fileName;

         $journal->save();

         return response()->json(['error' => false,
                'message' => 'Journal updated successfully',
                'code' => 200]);
        }
    }

    public function delete_journal(Request $request) {
        $journal_id = $request->journal_id;

        $journal_details = \App\Journal::find($journal_id);

        if($journal_details) {
            $journal_details->delete();
            return response()->json(['error' => false,
                'message' => 'Journal deleted successfully',
                'code' => 200]);
        }
        else {
            return response()->json(['error' => true,
                'message' => 'Journal not found',
                'code' => 500]);
        }
    }

    public function delete_drug(Request $request) {
        $drug_id = $request->drug_id;

        $drug_details = Drug::find($drug_id);

        if($drug_details) {
            $drug_details->delete();
            return response()->json(['error' => false,
                'message' => 'Drug deleted successfully',
                'code' => 200]);
        }
        else {
            return response()->json(['error' => true,
                'message' => 'Drug not found',
                'code' => 500]);
        }
    }

    public function contact_address(Request $request) {
        $contact = \App\Organization::all();
        return response()->json(['contact_address' => $contact[0]['address'],'status_code'=>200]);
    }


    public function cms(Request $request) {
        $slug = $request->slug;
        $cms_details = \App\CMS::where('slug',$slug)->get()->toArray();
        return response()->json(['cms_details' => $cms_details,'status_code'=>200]);

    }
    public function getfooter(Request $request) {
        
        $footerdata = \App\Organization::all();
        $footer_des = \App\CMS::where('slug','about-us')->get()->toArray();
        return response()->json(['footer_item' => $footerdata,'footer_des' => $footer_des,'status_code'=>200]);

    }

    public function get_type(Request $request) {
        $user = JWTAuth::toUser($request->token);
        return response()->json(['type' => $user->type]);
    }

    public function update_company_profile(Request $request) {
        $doctors = Doctor::find($request->doctor_id);
        
        if($doctors) {
            $doctors->first_name = $request->first_name;
            $doctors->email = $request->email;
            $doctors->mobile = $request->mobile;
            $doctors->state_id = $request->state_id;
            $doctors->city = $request->city;
            $doctors->pincode = $request->pincode;
            $doctors->doe = date('Y-m-d',strtotime($request->doe));
            $doctors->company_regsitration_no = $request->company_registration_no;
            $doctors->biography = $request->biography;
            $doctors->address = $request->address;
            $doctors->testimonial = $request->testimonial;

            $doctors->save();
            
            return response()->json(['status_code'=>200,'message'=>'Profile updated successfully']);
        }
        else {
            return response()->json(['status_code'=>500,'message'=>'Please try again']);
        }
    }

    public function add_new_drug(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:50',
            'description' => 'required',
            'department_id' => 'required',
            'mfg_name' => 'required|max:50',
            'unit' => 'required|max:20',
            'price' => 'required|between:0,999.99',
            'image' => 'required|mimes:jpg,jpeg,pdf,png|max:500000',
            'video' => 'required_with|mimes:mp4,wmv|max:500000'
        ],[
            'title.required' => 'Please enter medicine name',
            'title.max:50' => 'Name should have maximum 50 characters',
            'description.required' => 'Please enter description',
            'department_id.required' => 'Please select medical category',
            'mfg_name.required' => 'Please enter manufacturing company name',
            'mfg_name.max:50' => 'Manufacturing name should have maximum 50 characters'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
            try {
                if($request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $this->imageName = time().'_'.$file->getClientOriginalName() ;

                    $destinationPath = public_path().'/uploads/company/medicine/image/' ;
                    $file->move($destinationPath,$this->imageName);


                }
               

                if($request->hasFile('video')) {
                    $file = $request->file('video') ;

                    $this->videoName = time().'_'.$file->getClientOriginalName() ;

                    $destinationPath = public_path().'/uploads/company/medicine/video/' ;
                    $file->move($destinationPath,$this->videoName);
                }

                $drug = new \App\Drug();
                $drug->title = $request->title;
                $drug->description = $request->description;
                $drug->department_id = $request->department_id;
                $drug->doctor_id = $request->company_id;
                $drug->image = $this->imageName;
                $drug->mfg_name = $request->mfg_name;
                $drug->unit = $request->unit;
                $drug->price = $request->price;
                $drug->video = $this->videoName;

                $drug->save();

                return response()->json(['error' => false,
                'message' => "New medicine addedd successfully",
                'code' => 200]);
            }
            catch (Exception $e) {
                return response()->json(['error' => true,
                'message' => "Something is not right. Please try again",
                'code' => 500]);
            }
        }
    }


    public function edit_new_drug(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:50',
            'description' => 'required',
            'department_id' => 'required',
            'mfg_name' => 'required|max:50',
            'unit' => 'required|max:20',
            'price' => 'required|between:0,999.99',
            'image' => 'required_with|mimes:jpg,jpeg,pdf,png|max:500000',
            'video' => 'required_with|mimes:mp4,wmv|max:500000'
        ],[
            'title.required' => 'Please enter medicine name',
            'title.max:50' => 'Name should have maximum 50 characters',
            'description.required' => 'Please enter description',
            'department_id.required' => 'Please select medical category',
            'mfg_name.required' => 'Please enter manufacturing company name',
            'mfg_name.max:50' => 'Manufacturing name should have maximum 50 characters'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
            $drug =Drug::find($request->id);
            try {
                if($request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $this->imageName = time().'_'.$file->getClientOriginalName() ;

                    $destinationPath = public_path().'/uploads/company/medicine/image/' ;
                    $file->move($destinationPath,$this->imageName);

                    $imagefilename=$this->imageName;
                }
                else
                {
                    $imagefilename=$drug->image;
                }

                if($request->hasFile('video')) {
                    $file = $request->file('video') ;

                    $this->videoName = time().'_'.$file->getClientOriginalName() ;

                    $destinationPath = public_path().'/uploads/company/medicine/video/' ;
                    $file->move($destinationPath,$this->videoName);

                    $vediofilename=$this->videoName;
                }
                else
                {
                    $vediofilename=$drug->video;
                }
                 
                $drug->title = $request->title;
                $drug->description = $request->description;
                $drug->department_id = $request->department_id;
                $drug->doctor_id = $request->company_id;
                $drug->image = $imagefilename;
                $drug->mfg_name = $request->mfg_name;
                $drug->unit = $request->unit;
                $drug->price = $request->price;
                $drug->video = $vediofilename;

                $drug->save();

                return response()->json(['error' => false,
                'message' => "Medicine Updated successfully",
                'code' => 200]);
            }
            catch (Exception $e) {
                return response()->json(['error' => true,
                'message' => "Something is not right. Please try again",
                'code' => 500]);
            }
        }
    }

    public function payment_details(Request $request) {

        $doctor_payment_details = Doctor::with('doctor_qualifications')->where('id',$request->doctor_id)->get()->toArray();
        $payment_details = array('payment'=>$doctor_payment_details[0]['payment'],'date_of_payment'=>$doctor_payment_details[0]['date_of_payment'],'payment_type'=>$doctor_payment_details[0]['payment_type'],'bank_name'=>$doctor_payment_details[0]['bank_name'],'branch_name'=>$doctor_payment_details[0]['branch_name'],'cheque_no'=>$doctor_payment_details[0]['cheque_no']);

        $qualification_arr = [];
        foreach ($doctor_payment_details[0]['doctor_qualifications'] as $key => $value) {
            $qualification_arr[] = strval($value['id']);
        }

        $certificates_arr = explode(",", $doctor_payment_details[0]['certificate']);

        return response()->json(['payment_details'=>$payment_details,'qualification_arr'=>$qualification_arr,'certificates_arr'=>$certificates_arr]);
    }

    

    public function drug_details(Request $request) {
        $drug_id = $request->drug_id;

        $drug_details = Drug::where('id',$drug_id)->get()->toArray();

        return response()->json(['drug_details' => $drug_details]);
    }

    public function group_list(Request $request) {

        try{   
            $user = JWTAuth::toUser($request->header('token'));
            if($user->type == "D") {
                $group_list = \App\Group::where('doctor_id',$user->id)->paginate(2);
                
                 return response()->json(['group_list' => $group_list,'status_code'=>200]);

            }
            else {
                return response()->json(['error' => false,
                'message' => "Not authorized to access",
                'group_list' => $group_list,
                'code' => 500]);
            }
            }catch (JWTException $e) {
                return response()->json(['error' => true,
                'message' => "Something is not right. Please try again",
                'code' => 500]);
            }
    }

    public function drug_list(Request $request)
    {
       
       $user = JWTAuth::toUser($request->header('token'));
       
       //$drug_list = Drug::where('doctor_id',$doctor_id)->whereNotNull('video')->get()->toArray();
       $drug_list = Drug::where('doctor_id',$user->id)->whereNotNull('video')->paginate(3);
        
        return response()->json(['drug_list' => $drug_list,'status_code'=>200]);

    }

    public function add_group(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:20',
            'description' => 'required',
            'no_of_people' => 'required|numeric|min:1|max:100',
            'status' => 'required'
        ],[
            'name.required' => 'Please enter group name',
            'name.max:20' => 'Group name should not be more than 20 characters',
            'description.required' => 'Please enter description',
            'no_of_people.required' => 'Please enter no of people in that group',
            'no_of_people.numeric' => 'It should be only number',
            'no_of_people.min:1' => 'It should have minimum 1 member',
            'no_of_people.max:100' => 'It should have maximum 100 member',
            'status.required' => 'Please select status'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
            $user = JWTAuth::toUser($request->header('token'));
            $group = new \App\Group();
            $group->name = $request->name;
            $group->description = $request->description;
            $group->no_of_people = $request->no_of_people;
            $group->status = $request->status;
            $group->doctor_id = $user->id;

            $group->save();

            return response()->json(['error' => false,
                'message' => 'Group addedd successfully',
                'code' => 200]);
        }
    }

    public function group_details(Request $request) {
        $group_id = $request->group_id;
        try {
            $user = JWTAuth::toUser($request->header('token'));
            $group_details = \App\Group::find($group_id);
            return response()->json(['group_details'=>$group_details,'error'=>false,'code'=>200]);
        }
        catch(JWTException $e) {
            return response()->json(['message'=>'Session expired','error'=>true,'code'=>500]);
        }
    }

    public function edit_group(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:20',
            'description' => 'required',
            'no_of_people' => 'required|numeric|min:1|max:100',
            'status' => 'required'
        ],[
            'name.required' => 'Please enter group name',
            'name.max:20' => 'Group name should not be more than 20 characters',
            'description.required' => 'Please enter description',
            'no_of_people.required' => 'Please enter no of people in that group',
            'no_of_people.numeric' => 'It should be only number',
            'no_of_people.min:1' => 'It should have minimum 1 member',
            'no_of_people.max:100' => 'It should have maximum 100 member',
            'status.required' => 'Please select status'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true,
                'message' => $validator->messages()->first(),
                'code' => 500]);
        }
        else {
            $user = JWTAuth::toUser($request->header('token'));
            $group = \App\Group::find($request->group_id);
            
            $group->name = $request->name;
            $group->description = $request->description;
            $group->no_of_people = $request->no_of_people;
            $group->status = $request->status;
            $group->doctor_id = $user->id;

            $group->save();

            return response()->json(['error' => false,
                'message' => 'Group updated successfully',
                'code' => 200]);
        }
    }

    public function delete_group(Request $request) {
        $group = \App\Group::find($request->group_id);
        if($group->delete()) {
            return response()->json(['error' => false,
                'message' => 'Group deleted successfully',
                'code' => 200]);
        }
        else {
            return response()->json(['error' => true,
                'message' => 'Error!. Please try again',
                'code' => 500]);
        }
    }

    public function doctor_list(Request $request) {
        $user = JWTAuth::toUser($request->header('token'));
        $doctor_list = \App\Doctor::with('doctor_groups')->where('type','D')->where('id','<>',$user->id)->paginate(10);
        
        return response()->json(['doctor_list' => $doctor_list,'status_code'=>200]);
    }

    public function search_doctor(Request $request) {
        $term = $request->term;
        
        $token = $request->get('token');
        $arr = array();
        $doctors = \App\Doctor::where(function ($query) use ($term,$token) {
                $user = JWTAuth::toUser($token);
                $query->where('type', '=', 'D')->where('id','<>',$user->id);
                })->where(function ($query) use ($term) {
                $query->where('first_name', 'like', '%' . $term . '%')
                ->orWhere('last_name', 'like', '%' . $term . '%')
                ->orWhere('license', 'like', '%' . $term . '%');
                })->get();
        
        $data=array();
        foreach ($doctors as $value) {
            $data[]=array('value'=>$value->first_name." ".$value->last_name,'id'=>$value->id);
        }
        return $data;
        
    }

    public function doctor_search(Request $request) {
        $doctor_list = \App\Doctor::where('id',$request->doctor_id)->where('type','D')->paginate(10);
        
        return response()->json(['doctor_list' => $doctor_list,'status_code'=>200]);
    }

    public function find_doctors(Request $request) {
        $user = JWTAuth::toUser($request->header('token'));
        $receiver_details = \App\SendGroupRequest::select('receiver_id')->where('sender_id',$user->id)->get()->toArray();
        
        $find_doctors = \App\Doctor::where('type','D')->where('id','<>',$user->id)->get();

        $doctor_arr = array();

        foreach ($receiver_details as $key => $value) {
           $doctor_arr[] = $value['receiver_id'];
        }

        foreach ($find_doctors as $value) {

            if(!in_array($value->id, $doctor_arr)) {
                if(file_exists( public_path() . '/uploads/doctors/thumb/'.$value['avators']) && $value['avators']) {
                    $avators =  '/uploads/doctors/thumb/'.$value['avators'];
                } else {
                    $avators =  '/uploads/doctors/noimage_user.jpg';
                }
                $data[]=array('id'=>$value->id,'name'=>$value->first_name." ".$value->last_name,'avators'=>$avators,'license'=>$value->license);
            }
        }
        
        return response()->json(['find_doctors' => $data,'status_code'=>200]);
    }


    public function search_group(Request $request) {
        
        $grp = $request->term;
        
        
        $token = $request->get('token');
        $user = JWTAuth::toUser($token);
        $id=$user->id;

        $groups=\App\Group::where('doctor_id',$user->id)->where('name', 'like', '%' . $grp . '%')->get();
        
        $data=array();
        foreach ($groups as $value) {
            $data[]=array('value'=>$value->name,'id'=>$value->id);
        }
       
        return $data;
        
    }
    public function group_search_details(Request $request)
     {
       $group_id=$request->group_id;

       //$doctor_list = \App\Doctor::where('id',$request->doctor_id)->where('type','D')->paginate(10);

       //$group_name=$request->group_name;
       $group_search=\App\Group::where('id',$request->group_id)->paginate(10);
     
       return response()->json(['group_search' => $group_search,'status_code'=>200]);


        
    }

   public function search_drug(Request $request) {
        
        $drg = $request->term;
        
        $token = $request->get('token');
        $user = JWTAuth::toUser($token);
        $id=$user->id;
        $drugs=\App\Drug::where('doctor_id',$user->id)->where('title', 'like', '%' . $drg . '%')->get();
        
        $data=array();
        foreach ($drugs as $value) {
            $data[]=array('value'=>$value->title,'id'=>$value->id);
        }
        
        return $data;
        
    }





    public function drugs_search_details(Request $request)
     {
        $drug_id=$request->drug_id;

       
       //$group_search=\App\Group::where('id',$drug_id)->get()->toArray();
       $drug_search=\App\Drug::where('id',$drug_id)->paginate(10);
      
       return response()->json(['drug_search' => $drug_search,'status_code'=>200]);
        /*return response()->json(['error' => false,
                'message' => "Data Found",
                'group_search' => $group_search,
                'code' => 200]);*/
    }

    public function check_doctor_image(Request $request) {
        $avators = $request->avators;
        try {
            if(file_exists( public_path() .'/uploads/doctors/thumb/'.$avators)) {
                    return response()->json(['error' => false,
                        'code' => 200]);
                } else {
                    return response()->json(['error' => false,
                        'code' => 404]);
                  
                }
        }
        catch(Exception $e) {
            return response()->json(['error' => true,
                        'code' => 500]);
        }
    }

    public function group_by_doctors(Request $request) {
        $user = JWTAuth::toUser($request->header('token'));
        $doctor_id = $request->doctor_id;
        $doctor_details = \App\Doctor::find($doctor_id);
        $groups = \App\Group::where('doctor_id',$user->id)->orderBy('name')->get()->pluck('name','id')->toArray();
        return response()->json(['groups' => $groups,'doctor_details'=>$doctor_details]);
    }

    public function send_group_request(Request $request) {
        $user = JWTAuth::toUser($request->header('token'));
        $receiver_email_id = $request->receiver_email_id;
        $group_id = $request->group_id;
        $description = $request->description;
        try {
            $doctor_details = \App\Doctor::where('email',$receiver_email_id)->get()->toArray();


            $insert_data = new \App\SendGroupRequest();
            $insert_data->group_id = $group_id;
            $insert_data->sender_id = $user->id;
            $insert_data->receiver_id = $doctor_details[0]['id'];
            $insert_data->description = $description;

            $insert_data->save();

            return response()->json(['error' => false,
                'message' => "Request send successfully",
                'code' => 200]);
        }
        catch(Exception $e) {
            return response()->json(['error' => true,
                'message' => "Please try again",
                'code' => 500]);
        }
        

    }

    public function comment_data(Request $request) {

          if($request->hasFile('comment_file')) {
              $file = $request->file('comment_file') ;

            $filename= time().'_'.$file->getClientOriginalName() ;
                    $destinationPath = public_path().'/uploads/doctors/postnotification/' ;
                    $file->move($destinationPath,$filename);

                }
                else {
                    $filename='';
                }
         
        $user = JWTAuth::toUser($request->header('token'));
        $comments = new \App\Comment();
        $comment = $request->comment;
        
        $doctor_id=$user->id;
        
        //echo 'file'.$filename;die();
        $comments->doctor_id=$doctor_id;
        $comments->comment=$request->comment;
        $comments->group_id=0;
        $comments->replay_id=0;
        $comments->file=$filename;
        $comments->created_at=time();
        $comments->updated_at=time();
        $comments->save();
    }

    public function get_post_data(Request $request)
    {
        //echo 'hello';
        $user = JWTAuth::toUser($request->header('token'));
        $doctor_id=$user->id;
        
        /*$team_list = Team::with('designations')->where('status','1')->get()->toArray();
            $testimonial_list = Doctor::with('states')->where('status','1')->whereNotNull('testimonial')->get()->toArray();*/
      $getpostdata= \App\Doctor::with('comments')->where('id',$doctor_id)->get()->toArray();
      
       return response()->json(['getpostdata' => $getpostdata,'status_code'=>200]);
    }

}
