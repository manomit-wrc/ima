<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/home-content','PageController@home_content');
Route::post('/registration','PageController@registration');
Route::post('/login', 'PageController@login');
Route::get('/get-news','PageController@get_news');
Route::get('/get-events','PageController@get_events');
Route::post('/check-user-email','PageController@check_user_email');
Route::get('/activate-account','PageController@activate_account');
Route::get('/news-list','PageController@news_list');
Route::get('/events-list','PageController@events_list');
Route::get('/contact','PageController@contact_us');
Route::post('/contactsave','PageController@contact_save');
Route::get('/localbranch','PageController@local_branch');
Route::get('/contact-address','PageController@contact_address');
Route::get('/cms','PageController@cms');
Route::get('/footer','PageController@getfooter');




Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/doctors', 'PageController@getAuthUser');
    Route::get('/get-type','PageController@get_type');
    Route::get('/state-list', 'PageController@get_state_list');
    Route::get('/qualification-list', 'PageController@get_qualification_list');
    Route::post('/update-profile', 'PageController@update_profile');
    Route::post('/update-profile-photo','PageController@update_profile_photo');
    Route::post('/update-password','PageController@update_password');
    Route::get('/categories','PageController@categories');
    Route::get('/certificates','PageController@certificates');
    Route::post('/submit-journal','PageController@submit_journal');
    Route::post('/submit-doctorcertificate','PageController@submit_doctorcertificate');
    Route::get('/journal-list','PageController@journal_list');
    Route::get('/journal-details','PageController@journal_details');
    Route::get('/drug-details','PageController@drug_details');
    Route::post('/update-journal','PageController@update_journal');
    Route::get('/delete-journal','PageController@delete_journal');
    Route::get('/delete-drug','PageController@delete_drug');
    Route::post('/update-company-profile','PageController@update_company_profile');
    Route::post('/add-new-drug','PageController@add_new_drug');
    Route::post('/edit-new-drug','PageController@edit_new_drug');
    Route::get('/medical-category','PageController@medical_category');
    Route::get('/payment-details','PageController@payment_details');
    Route::get('/drug-list','PageController@drug_list');
    Route::get('/group-list','PageController@group_list');
    Route::post('/add-group','PageController@add_group');
    Route::get('/group-details','PageController@group_details');
    Route::post('/edit-group','PageController@edit_group');
    Route::get('/group-delete','PageController@delete_group');
    Route::get('/doctor-list','PageController@doctor_list');
    Route::get('/doctors/search','PageController@search_doctor');
    Route::get('/doctor-search','PageController@doctor_search');

    Route::get('/find-doctors','PageController@find_doctors');



    Route::get('/groups/search','PageController@search_group');
    Route::get('/group-search-details','PageController@group_search_details');

    

    Route::get('/drugs/search','PageController@search_drug');
    Route::get('/drugs-search-details','PageController@drugs_search_details');

    Route::get('/check-doctor-image','PageController@check_doctor_image');

    Route::get('/group-by-doctors','PageController@group_by_doctors');

    Route::post('/send-group-request','PageController@send_group_request');

    Route::post('/comment-data','PageController@comment_data');
    Route::get('/get-post-data','PageController@get_post_data');

});