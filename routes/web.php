<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile', function () {
    return view('welcome');
});
Route::get('/company-profile', function () {
    return view('welcome');
});
Route::get('/change-password', function () {
    return view('welcome');
});

Route::get('/upload-journal', function () {
    return view('welcome');
});

Route::get('/drug-list', function () {
    return view('welcome');
});

Route::get('/upload-drug', function () {
    return view('welcome');
});

Route::get('/journal-list', function () {
    return view('welcome');
});

Route::get('/news/{id}/{slug}', function () {
    return view('welcome');
});

Route::get('/activate/{active_token}/{active_time}', function () {
    return view('welcome');
});

Route::get('/news-list', function(){
    return view('welcome');
});

Route::get('/doctor-list', function(){
    return view('welcome');
});


Route::get('/group-request', function(){
    return view('welcome');
});

Route::get('/comment-list/{id}', function(){

    return view('welcome');
});

Route::get('/journal/{id}', function() {
    return view('welcome');
});
Route::get('/drug/{id}', function() {
    return view('welcome');
});

Route::get('/events-list', function(){
    return view('welcome');
});
Route::get('/contact', function(){
    return view('welcome');
});
Route::get('/branches', function(){
    return view('welcome');
});
Route::get('/about-us', function(){
    return view('welcome');
});

Route::get('/events/{events_id}/{slug}', function() {
    return view('welcome');
});  

Route::get('/payment-certificate', function(){
    return view('welcome');
});

Route::get('/groups', function(){
    return view('welcome');
});

Route::get('/groups/add', function(){
    return view('welcome');
});
Route::get('/groups/edit/{id}', function(){
    return view('welcome');
});

Route::get('/admin', 'LoginController@index');
Route::post('/admin/login', 'LoginController@checkLogin');

Route::group(['middleware'=>['admin']], function(){
	Route::get('/admin/logout', array('uses' => 'LoginController@logout'));
    Route::get('/admin/dashboard', 'DashboardController@index');
    Route::get('/admin/profile','DashboardController@profile');
    Route::post('/admin/update-profile','DashboardController@update_profile');
    Route::get('/admin/organization','DashboardController@organization');
    Route::post('/admin/update-organization','DashboardController@update_organization');


    Route::get('/admin/designation','DesignationController@index');
    Route::get('/admin/designation/add','DesignationController@add');
    Route::post('/admin/designation/store','DesignationController@store');
    Route::get('/admin/designation/edit/{id}','DesignationController@edit');
    Route::post('/admin/designation/update','DesignationController@update');
    Route::get('/admin/designation/delete/{id}','DesignationController@delete');


    Route::get('/admin/team','TeamController@index');
    Route::get('/admin/team/add','TeamController@add');
    Route::post('/admin/team/store','TeamController@store');
    Route::get('/admin/team/edit/{id}','TeamController@edit');
    Route::post('/admin/team/update','TeamController@update');
    Route::get('/admin/team/delete/{id}','TeamController@delete');


    Route::get('/admin/event-category','EventCategoryController@index');
    Route::get('/admin/event-category/add','EventCategoryController@add');
    Route::post('/admin/event-category/store','EventCategoryController@store');
    Route::get('/admin/event-category/edit/{id}','EventCategoryController@edit');
    Route::post('/admin/event-category/update','EventCategoryController@update');
    Route::get('/admin/event-category/delete/{id}','EventCategoryController@delete');


    Route::get('/admin/event','EventController@index');
    Route::get('/admin/event/add','EventController@add');
    Route::post('/admin/event/store','EventController@store');
    Route::get('/admin/event/edit/{id}','EventController@edit');
    Route::post('/admin/event/update','EventController@update');
    Route::get('/admin/event/delete/{id}','EventController@delete');
    Route::get('/admin/event/gallery/{id}','EventController@gallery');
    Route::post('/admin/event/store-gallery','EventController@store_gallery');
    Route::get('/admin/event/get-gallery/{id}','EventController@get_gallery');
    Route::get('/admin/event/remove-gallery-image/','EventController@remove_gallery_image');


    Route::get('/admin/banner','BannerController@index');
    Route::get('/admin/banner/add','BannerController@add');
    Route::post('/admin/banner/store','BannerController@store');
    Route::get('/admin/banner/edit/{id}','BannerController@edit');
    Route::post('/admin/banner/update/{id}','BannerController@update');
    Route::get('/admin/banner/delete/{id}','BannerController@delete');

    Route::get('/admin/bulletin','BulletinController@index');
    Route::get('/admin/bulletin/add','BulletinController@add');
    Route::post('/admin/bulletin/store','BulletinController@store');
    Route::get('/admin/bulletin/edit/{id}','BulletinController@edit');
    Route::post('/admin/bulletin/update/{id}','BulletinController@update');
    Route::get('/admin/bulletin/delete/{id}','BulletinController@delete');

    Route::get('/admin/local-branch','LocalBranchController@index');
    Route::get('/admin/local-branch/add','LocalBranchController@add');
    Route::post('/admin/local-branch/store','LocalBranchController@store');
    Route::get('/admin/local-branch/edit/{id}','LocalBranchController@edit');
    Route::post('/admin/local-branch/update/{id}','LocalBranchController@update');
    Route::get('/admin/local-branch/delete/{id}','LocalBranchController@delete');

    Route::get('/admin/tag','TagController@index');
    Route::get('/admin/tag/add','TagController@add');
    Route::post('/admin/tag/store','TagController@store');
    Route::get('/admin/tag/edit/{id}','TagController@edit');
    Route::post('/admin/tag/update/{id}','TagController@update');
    Route::get('/admin/tag/delete/{id}','TagController@delete');

    Route::get('/admin/news','NewsController@index');
    Route::get('/admin/news/add','NewsController@add');
    Route::post('/admin/news/store','NewsController@store');
    Route::get('/admin/news/edit/{id}','NewsController@edit');
    Route::post('/admin/news/update/{id}','NewsController@update');
    Route::get('/admin/news/delete/{id}','NewsController@delete');

    Route::get('/admin/cms','CMSController@index');
    Route::get('/admin/cms/add','CMSController@add');
    Route::post('/admin/cms/store','CMSController@store');
    Route::get('/admin/cms/edit/{id}','CMSController@edit');
    Route::post('/admin/cms/update/{id}','CMSController@update');
    Route::get('/admin/cms/delete/{id}','CMSController@delete');

    Route::get('/admin/doctor','DoctorController@index');
    Route::get('/admin/doctor/view/{id}','DoctorController@view');
    Route::get('/admin/doctor/Publised/{id}/{status}','DoctorController@Publised');
    Route::post('/admin/doctor/active','DoctorController@active');
    Route::get('/admin/doctor/downloadjournal/{file}','DoctorController@downloadjournal');
    Route::get('/admin/doctor/downloadcertificate/{file}','DoctorController@downloadcertificate');
    
   
    Route::get('/admin/notice','NoticeController@index');
    Route::get('/admin/notice/add','NoticeController@add');
    Route::post('/admin/notice/store','NoticeController@store');
    Route::get('/admin/notice/edit/{id}','NoticeController@edit');
    Route::post('/admin/notice/update/{id}','NoticeController@update');
    Route::get('/admin/notice/delete/{id}','NoticeController@delete');


    Route::get('/admin/company','CompanyController@index');
    Route::get('/admin/company/add','CompanyController@add');
    Route::post('/admin/company/store','CompanyController@store');
    Route::get('/admin/company/edit/{id}','CompanyController@edit');
    Route::post('/admin/company/update','CompanyController@update');
    Route::get('/admin/company/delete/{id}','CompanyController@delete');
    Route::get('/admin/company/changepassword/{id}','CompanyController@changepassword');
    Route::post('/admin/company/updatepassword','CompanyController@updatepassword');

    
    Route::get('/admin/qualification','QualificationController@index');
    Route::get('/admin/qualification/add','QualificationController@add');
    Route::post('/admin/qualification/store','QualificationController@store');
    Route::get('/admin/qualification/edit/{id}','QualificationController@edit');
    Route::post('/admin/qualification/update','QualificationController@update');
    Route::get('/admin/qualification/delete/{id}','QualificationController@delete');


    Route::get('/admin/department','DepartmentController@index');
    Route::get('/admin/department/add','DepartmentController@add');
    Route::post('/admin/department/store','DepartmentController@store');
    Route::get('/admin/department/edit/{id}','DepartmentController@edit');
    Route::post('/admin/department/update/{id}','DepartmentController@update');
    Route::get('/admin/department/delete/{id}','DepartmentController@delete');

});